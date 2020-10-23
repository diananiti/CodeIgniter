<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class vote extends CI_Controller {

    private $_validation_rules = array(
        array(
            'field' => 'artist_id',
            'label' => 'artist_id',
            'rules' => 'trim|max_length[255]|required'
        ),
        array(
            'field' => 'vote',
            'label' => 'vote',
            'rules' => 'trim|less_than[5.000001]|required'
        ),
        array(
            'field' => 'comment',
            'label' => 'comment',
            'rules' => 'trim|max_length[255]|required'
        ),
    );

// metoda construct
    function __construct() {
        parent::__construct();
       
        $this->load->model('vote_m');
        $this->load->helper('form');
        $this->load->helper('url');
        $artist = $this->vote_m->getArtist();
        $artist_f = array();
        foreach ($artist->result() as $row) {
            $artist_f[$row->id] = $row->fullname . ' from ' . $row->country;
        }
        $this->artist_combo = $artist_f;

        $this->load->library('form_validation');
    }

    public function index() {
        //      check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }

        $result = $this->vote_m->getAll();
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'index.php/vote/index';
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
        $this->pagination->initialize($config);
        $offset = 0;
        if (strlen(trim($this->uri->segment(3))) > 1) {
            $offset = $this->uri->segment(3);
            if ($offset <= 0) {
                $offset = 1;
            }
        }
        $result = $this->vote_m->getAll($config['per_page'], $offset);

        $data['results'] = $result;

        $data['pagination_links'] = $this->pagination->create_links();
        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'vote_view/index';
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
            $input['users_id'] = $user['id'];

            if ($this->vote_m->insert_vote($input) != 0) {
                redirect('/vote', 'refresh');
            }
        }
        $data['data']['artist_combo'] = $this->artist_combo;
        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'vote_view/add_view';

        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }

    public function edit($id = 0) {
        //      check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }

//update
// afisezi view add_view
        $data = array();
        $data['op'] = 'edit/' . $id;
        $this->form_validation->set_rules($this->_validation_rules);
        if ($this->form_validation->run()) {
            if ($this->vote_m->update_vote($id, $this->input->post()) != 0) {
                redirect('/vote', 'refresh');
            }
        }

        $data['results'] = $this->vote_m->getOne($id);

        $data['artist_combo'] = $this->artist_combo;
        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'vote_view/add_view';

        $data['data'] = '';
        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }

//delete 
    public function delete($id) {
        $this->vote_m->delete_vote($id);
        redirect('/vote', 'refresh');
    }

}
