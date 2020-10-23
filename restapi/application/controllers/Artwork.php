<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Artwork extends CI_Controller {

    private $_validation_rules = array(
        array(
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'trim|max_length[255]|required'
        ),
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|max_length[255]|required'
        ),
        array(
            'field' => 'content',
            'label' => 'Content',
            'rules' => 'trim|required'
        ),
    );

    function __construct() {
        parent::__construct();
        $this->load->model('artist_m');
        $this->load->model('artwork_m');
        $this->load->model('artworkartist_m');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');

        $artists = $this->artworkartist_m->getArtists();
        $artists_f = array();

        foreach ($artists->result() as $row) {
            $artists_f[$row->id] = $row->fullname;
        }
        $this->artists_combo = $artists_f;
    }

    public function index() {
        //      check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }

        $result = $this->artwork_m->getAll();
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'index.php/artwork/index';
        $config['total_rows'] = $result->num_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = ' <ul class="pagination pagination-lg">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<div>';
        $config['first_tag_close'] = '</div>';
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<div>';
        $config['last_tag_close'] = '</div>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

//      Start of pagination
        $this->pagination->initialize($config);

        $offset = 0;
        if (strlen(trim($this->uri->segment(3))) > 1) {
            $offset = $this->uri->segment(3);
            if ($offset <= 0) {
                $offset = 1;
            }
        }

        $result = $this->artwork_m->getAll($config['per_page'], $offset);
        $data['results'] = $result;

        $data['pagination_links'] = $this->pagination->create_links();
//      End of pagination

        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'artwork_view/index';
        $data['data'] = '';

        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }

    public function add() {
        //      check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }
        //insert
        $this->form_validation->set_rules($this->_validation_rules);
        $data = array();
        $data['op'] = 'add';

        if ($this->form_validation->run()) {
            $input = $this->input->post();

            $user = $this->session->userdata('user');

            $input['user_id'] = $user['id'];

            $input['artwork_id'] = $this->artwork_m->insert_artwork($input);

            $input['artist_id'] = $this->input->post('artists_to[]');

            if ($input['artist_id']) {
                $this->artworkartist_m->insert_artworkartist($input);
            }

            redirect('/artwork', 'refresh');
        }

        $this->load->view('layout/admin/header');

        $data['artists_combo'] = $this->artists_combo;

        $data['viewpath'] = 'artwork_view/add_view';
        $data['data'] = '';
        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }

    public function edit($id = 0) {
        //      check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }
        $data = array();
        $data['op'] = 'edit/' . $id;

//      Change date_of_birth format from YYYY/MM/DD to DD/MM/YYYY for user
        $results = $this->artwork_m->getOne($id);

        $this->form_validation->set_rules($this->_validation_rules);
        if ($this->form_validation->run()) {
            $input = $this->input->post();

            $user = $this->session->userdata('user');
            $input['user_id'] = $user['id'];
            $input['artwork_id'] = $id;
            $input['artist_id'] = array();
            $input['artist_id'] = $this->input->post('artists_to[]');

            if ($input['artist_id']) {
                $this->artworkartist_m->insert_artworkartist($input);
            }

            if ($this->artwork_m->update_artwork($id, $input) != 0) {
                redirect('/artwork', 'refresh');
            }
        }
        $this->load->view('layout/admin/header');
        $data['results'] = $this->artwork_m->getOne($id);
        $data['data'] = '';

        $this->load->view('layout/admin/header');




        $data['artists_combo'] = $this->artists_combo;
//        $id = '48';
//        $test = array($id => $data['artists_combo'][$id]);
//        var_dump($test);
//        var_dump($data['artists_combo']);
//        die();




        $data['viewpath'] = 'artwork_view/add_view';

        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }

    public function delete($id) {
//      Delete artwork from db
        $this->artworkartist_m->delete_artworkartist($id);
        $this->artwork_m->delete_artwork($id);
        redirect('/artwork', 'refresh');
    }

}
