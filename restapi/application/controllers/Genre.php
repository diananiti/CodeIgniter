<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class genre extends CI_Controller {

    private $_validation_rules = array(
        array(
            'field' => 'name',
            'label' => 'name',
            'rules' => 'trim|max_length[255]|required'
        ),
    );

    function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('genre_m');
        $this->load->helper('form');
        $this->load->helper('url');

        $this->load->library('form_validation');
    }

    public function index() {
        //      check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }

//pagination
        $totalrows = $this->genre_m->getAll();
        $config['base_url'] = site_url() . '/genre/index';
        $config['total_rows'] = $totalrows->num_rows();
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
        if (strlen(trim($this->uri->segment(3))) > 1) {
            $offset = $this->uri->segment(3);
            if ($offset <= 0) { // number of post to displace or pass over
                $offset = 1;
            }
        } else {
            $offset = $this->uri->segment(3);

            if ($offset <= 0) {
                $offset = 1;
            }
        }
        $this->pagination->initialize($config);
        $data['pagination_links'] = $this->pagination->create_links();

        if (strlen(trim($this->uri->segment(3))) > 1) {
            $offset = $this->uri->segment(3);
            if ($offset <= 0) {
                $offset = 1;
            }
        } else {
            $offset = $this->uri->segment(3);

            if ($offset <= 0) {
                $offset = 1;
            }
        }
//
        $results = $this->genre_m->getAll($config['per_page'], $offset); //memorize the data (coming from model) that is neccessary for pagination,in a variable
        $data['results'] = $results;
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'genre_view/genre_show'; //the place where the data is shown
        $data['data'] = ''; //tells the data is an string type 
        $this->load->view('layout/admin/content', $data); //it displays the data in the content-layout
        $this->load->view('layout/admin/footer');
    }

    public function add() {
        //      check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }

        $this->form_validation->set_rules($this->_validation_rules);
        $data = array();
        $data['op'] = 'add';
        if ($this->form_validation->run()) {
            if ($this->genre_m->insert_genre($this->input->post()) != 0) {
                redirect('/genre', 'refresh');
            }
        }$this->load->view('layout/admin/header');
        $data['viewpath'] = 'genre_view/genre_add';
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
        $this->form_validation->set_rules($this->_validation_rules);
        if ($this->form_validation->run()) {
            if ($this->genre_m->updateGenre($id, $this->input->post()) != 0) {
                redirect('/genre', 'refresh');
            }
        }
        $this->load->view('layout/admin/header');
        $data['results'] = $this->genre_m->get_one($id); //memorize the results came from a method in the model
        $this->load->view('genre_view/genre_add', $data); //send that results to the view
        $this->load->view('layout/admin/footer');
    }

    public function delete($id) {
        $this->genre_m->delete($id);
        redirect('/genre', 'refresh');
    }

}
