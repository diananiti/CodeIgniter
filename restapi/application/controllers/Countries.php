<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class countries extends CI_Controller {

    //validarea
    private $_validation_rules = array(
        array(
            'field' => 'country',
            'label' => 'country',
            'rules' => 'trim|max_length[255]|required'
        ),
    );

    function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('countries_m');
        $this->load->helper('form');
        $this->load->helper('url');
        $continents = $this->countries_m->getContinents();
        $continents_f = array();
        foreach ($continents->result() as $row) {
            $continents_f[$row->id] = $row->continent;
        }
        $this->continents_combo = $continents_f;
        $this->load->library('form_validation');
    }

    public function index() {
        //      check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }

        $totalrows = $this->countries_m->getAll();

        $config['base_url'] = site_url() . '/countries/index';
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
        $config['next_link'] = '&gt;'; // &gt=Greater than
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;'; //&lt=less than
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        if (strlen(trim($this->uri->segment(3))) > 1) {
            $offset = $this->uri->segment(3);
            if ($offset <= 0) { //number of post to displace or pass over
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
        $results = $this->countries_m->getAll($config['per_page'], $offset);
        $data['results'] = $results;
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'countries_view/countries_show';
        $data['data'] = '';
        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }

    public function add() {
        //      check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }

        $this->form_validation->set_rules($this->_validation_rules);
        $data = array();
        $data['op'] = 'add'; // tells that the operation is to be 'add'
        $data['continents_combo'] = $this->continents_combo; //memorize the combo
        if ($this->form_validation->run()) {
            if ($this->countries_m->insert_countries($this->input->post()) != 0) {
                redirect('/countries', 'refresh');
            }
        }
        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'countries_view/countries_add';
        $data['data'] = ''; //tells the fields from data  are strings 

        $this->load->view('layout/admin/content', $data); //add all that data in the content from view
        $this->load->view('layout/admin/footer');
    }

    public function edit($id = 0) {
        //      check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }

        $data = array();
        $data['op'] = 'edit/' . $id; //tells that the operation is going to be edit
        $this->form_validation->set_rules($this->_validation_rules);

        if ($this->form_validation->run()) {

            if ($this->countries_m->update_country($id, $this->input->post()) != 0) {//update the country ,if the data that comes with  post !=0...,then redirect
                redirect('/countries', 'refresh');
            }
        }
        $data['results'] = $this->countries_m->get_one($id); //get the id in the models/method get_one into a variable 

        $data['continents_combo'] = $this->continents_combo;
        $this->load->view('layout/admin/header');
        $this->load->view('countries_view/countries_add', $data);
        $this->load->view('layout/admin/footer');
    }

    public function delete($id) {
        $this->countries_m->delete($id);
        redirect('/countries', 'refresh');
    }

}
