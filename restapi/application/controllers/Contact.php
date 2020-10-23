<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class contact extends CI_Controller {

    private $_validation_rules = array(
        array(
            'field' => 'name',
            'label' => 'name',
            'rules' => 'trim|max_length[255]|required'
        ),
        array(
            'field' => 'email',
            'label' => 'email',
            'rules' => 'trim|max_length[255]|valid_email|required'
        ),
        array(
            'field' => 'message',
            'label' => 'message',
            'rules' => 'trim|max_length[255]|required'
        ),
        array(
            'field' => 'recaptcha',
            'label' => 'reCaptcha',
            'rules' => 'trim|callback_validate_recaptcha',
        ),
    );

    // metoda construct
    function __construct() {
        parent::__construct();

        $this->load->model('contact_m');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->config->load('config');
        $this->load->library('form_validation');
        $this->load->helper('captcha');
    }

    public function index() {
        //insert
        $this->form_validation->set_rules($this->_validation_rules);
        $data = array();
        $data['data']['op'] = 'index';
        if ($this->form_validation->run()) {
            if ($this->contact_m->insert_contact($this->input->post()) != 0) {
                //redirect('/contact', 'refresh');
            }
        }
        $this->load->view('layout/frontend/header');
        $data['viewpath'] = 'contact_page/index';
//        $data['data'] = '';
        $this->load->view('layout/frontend/content', $data);
        $this->load->view('layout/frontend/footer');
    }

    // public function test() {
    // $data['viewpath'] = 'contact_page/index';
    // $data['data'] = '';
    //$this->load->view('layout/frontend/header');
    //$this->load->view('layout/frontend/content', $data);
    //$this->load->view('layout/frontend/footer');
    // }

    public function manage() {
        //      check the session user data if exist the user and is logged in
        // if (!$this->session->userdata('user')) {
        //redirect('/user/login');
        // }
        //In index is the show form an pagination
        $result = $this->contact_m->getAll();
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'index.php/contact/admin';
        $config['total_rows'] = $result->num_rows();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['num_links'] = 2;
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

        //Pagination
        $this->pagination->initialize($config);
        $offset = 0;
        if (strlen(trim($this->uri->segment(3))) > 1) {
            $offset = $this->uri->segment(3);
            if ($offset <= 0) {
                $offset = 1;
            }
        }
        $result = $this->contact_m->getAll($config['per_page'], $offset);
        $data['results'] = $result;
        $data['pagination_links'] = $this->pagination->create_links();
        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'contact_page/admin';
        $data['data'] = '';
        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }

    //if ($this->session->userdata('user')) {
    //redirect('/contact', 'refresh');
    //}
    // $input = array(
    //  'name' => $this->input->post('name'),
    // 'email' => $this->input->post('email'),
    // 'message' => $this->input->post('message'),
    // );
    //  $this->form_validation->set_rules($this->_validation_rules);
    // if ($this->form_validation->run()) {
    // $this->contact_m->insert_contact($input);
//      Login user after registration is compleate and successful
    //  $this->session->userdata('user');
    //  redirect('/contact', 'refresh');
    //  }
    // $data['viewpath'] = 'contact_page/index';
    // $data['data'] = '';
    //$this->load->view('layout/frontend/header');
    // $this->load->view('layout/frontend/content', $data);
    // $this->load->view('layout/frontend/footer');


    public function add() {
        //      check the session user data if exist the user and is logged in
        //  if (!$this->session->userdata('user')) {
        //redirect('/user/login');
        //  }
        //insert
        $this->form_validation->set_rules($this->_validation_rules);
        $data['data'] = array();
        $data['data']['op'] = 'add';

        $input = $this->input->post();
        $user = $this->session->userdata('user');
        $input['user_id'] = $user['id'];
        if ($this->form_validation->run()) {
            // var_dump($input['content']);
            // die();
            if ($this->contact_m->insert_contact($input)) {
                redirect('/contact', 'refresh');
            }
        }
        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'contact_page/add_view';
        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }

    public function edit($id = 0) {
        //check the session user data if exist the user and is logged in
        //  if (!$this->session->userdata('user')) {
        // redirect('/user/login');
        // }
        //update
        // afisezi view add_view
        $data = array();
        $data['op'] = 'edit/' . $id;
        $this->form_validation->set_rules($this->_validation_rules);
        if ($this->form_validation->run()) {
            $input = $this->input->post();
            $user = $this->session->userdata('user');
            $input['user_id'] = $user['id'];

            if ($this->contact_m->update_contact($id, $input)) {
                redirect('/contact', 'refresh');
            }
        }
        $data['data']['results'] = $this->contact_m->getOne($id);
        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'contact_page/add_view';
        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }

    //delete 
    public function delete($id) {
        $this->contact_m->delete_contact($id);
        redirect('/contact', 'refresh');
    }

    public function validate_recaptcha() {
        if (!$this->input->post('g-recaptcha-response')) {
            $this->form_validation->set_message('validate_recaptcha', 'reCaptcha is not done!');
            return false;
        } else {
            return true;
        }
    }

}
