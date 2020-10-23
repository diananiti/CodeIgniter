<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Artist extends CI_Controller {

    private $_validation_rules = array(
        array(
            'field' => 'fullname',
            'label' => 'Fullname',
            'rules' => 'trim|max_length[255]|required'
        ),
        array(
            'field' => 'vote',
            'label' => 'Vote',
            'rules' => 'trim|required|less_than[11]'
        ),
        array(
            'field' => 'artworks',
            'label' => 'Artworks',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'date_of_birth',
            'label' => 'Date of Birth',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'bio',
            'label' => 'Bio',
            'rules' => 'trim|max_length[255]'
        ),
    );

    function __construct() {
        parent::__construct();

        $this->load->model('artist_m');
        $this->load->model('artwork_m');
        $this->load->model('vote_m');
        $this->load->model('pages_m');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('calendar');

//      Get data for db join

        $genre = $this->artist_m->getGenre();
        $genre_f = array();

        foreach ($genre->result() as $row) {
            $genre_f[$row->id] = $row->name;
        }
        $this->genre_combo = $genre_f;

        $style = $this->artist_m->getStyle();
        $style_f = array();

        foreach ($style->result() as $row) {
            $style_f[$row->id] = $row->style;
        }
        $this->style_combo = $style_f;

        $countries = $this->artist_m->getCountries();
        $countries_f = array();

        foreach ($countries->result() as $row) {
            $countries_f[$row->id] = $row->country;
        }
        $this->countries_combo = $countries_f;

        $users = $this->artist_m->getUsers();
        $users_f = array();

        foreach ($users->result() as $row) {
            $users_f[$row->id] = $row->fullname;
        }
        $this->users_combo = $users_f;
    }

    public function index() {
        //      check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }

        $result = $this->artist_m->getAll();
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'index.php/artist/index';
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

        $result = $this->artist_m->getAll($config['per_page'], $offset);
        $data['results'] = $result;

        $data['pagination_links'] = $this->pagination->create_links();
//      End of pagination

        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'artist_view/index';
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
//      Initializate avatar if nothing is selected
            $input['avatar'] = '';

//      upload avatar
            $config['upload_path'] = './avatars/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = TRUE;
//        $config['max_size'] = '100';
//        $config['max_width'] = '1024';
//        $config['max_height'] = '768';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload("avatar")) {
                $data['error'] = array('error' => $this->upload->display_errors());
            } else {
                $avatar = $this->upload->data();
                $input['avatar'] = $avatar['file_name'];
                $data = array('upload_data' => $this->upload->data());
            }

            $this->artist_m->insert_artist($input);
            redirect('/artist', 'refresh');
        }

        $this->load->view('layout/admin/header');

        $data['data']['genre_combo'] = $this->genre_combo;
        $data['data']['style_combo'] = $this->style_combo;
        $data['data']['countries_combo'] = $this->countries_combo;
        $data['data']['users_combo'] = $this->users_combo;

        $data['viewpath'] = 'artist_view/add_view';

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

        $data['data']['genre_combo'] = $this->genre_combo;
        $data['data']['style_combo'] = $this->style_combo;
        $data['data']['countries_combo'] = $this->countries_combo;
        $data['data']['users_combo'] = $this->users_combo;

        $results = $this->artist_m->getOne($id);

        $this->form_validation->set_rules($this->_validation_rules);
        if ($this->form_validation->run()) {
            $input = $this->input->post();

            $input['avatar'] = $results->avatar;

//      Upload stuff
            $config['upload_path'] = './avatars/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload("avatar")) {
                $data['data']['error'] = array('error' => $this->upload->display_errors());
            } else {
//      Delete old avatar if new one is inserted
                if ($input['avatar']) {
                    unlink("./avatars/" . $input['avatar']);
                }
//      Insert new avatar's name into db
                $avatar = $this->upload->data();
                $input['avatar'] = $avatar['file_name'];
                $data = array('upload_data' => $this->upload->data());
            }

            if ($this->artist_m->update_artist($id, $input) != 0) {
                redirect('/artist', 'refresh');
            }
        }
        $this->load->view('layout/admin/header');
        $data['results'] = $this->artist_m->getOne($id);

        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'artist_view/add_view';

        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }

    public function profile($id = 0) {
        $data['data']['pages'] = $this->pages_m->getAll()->result();


        $artists = $this->artist_m->getOneArtist($id);
        $artworks = $this->artwork_m->last5artworks($id);
        $votes = $this->vote_m->last5votes($id);

        $data['artist'] = $artists->result()[0];
        $data['artworks'] = $artworks;
        $data['votes'] = $votes;
        $data['viewpath'] = 'view_profile/profile_index';
        //  $data['data'] = '';
        //  var_dump($data['artworks']);
        //  var_dump($data['artist']);
        // die();
        
        $this->load->view('layout/frontend/header');
        
        $this->load->view('layout/frontend/content', $data);
        $this->load->view('layout/frontend/footer');
    }
    
    public function delete($id) {
        $results = $this->artist_m->getOne($id);

//      Delete avatar if it exists
        if ($results->avatar) {
            unlink("./avatars/" . $results->avatar);
        }

//      Delete artist from db
        $this->artist_m->delete_artist($id);
        redirect('/artist', 'refresh');
    }

}
