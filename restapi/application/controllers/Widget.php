<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class widget extends CI_Controller {

    private $_validation_rules = array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|max_length[255]|required'
        ),
    );

    function __construct() {
        parent::__construct();

       
        $this->load->helper('form');
        $this->load->helper('url');
        $this->config->load('config');
        $this->load->library('form_validation');
        $this->load->model('pages_m');
        
    }

    public function index() {
        // check the session user data if exist the user and is loggedin
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }
        $data['user'] = $this->session->userdata('user');
        $this->load->view('layout/frontend/header');
        $data['viewpath'] = 'widget_view/index';
        $data['data'] = '';

        $this->load->view('layout/frontend/content', $data);
        $this->load->view('layout/frontend/footer');
    }

  

}
