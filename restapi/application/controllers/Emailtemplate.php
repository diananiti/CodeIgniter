<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class emailtemplate extends CI_Controller {

    private $_validation_rules = array(
        array(
            'field' => 'slug',
            'label' => 'slug',
            'rules' => 'trim|max_length[255]|required'
        ),
        array(
            'field' => 'title',
            'label' => 'title',
            'rules' => 'trim|max_length[255]|required'
        ),
        array(
            'field' => 'content',
            'label' => 'content',
            'rules' => 'trim|max_length[255]|required'
        ),
    );

    function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('emailtemplate_m');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index() {
        //      check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }
        //In index is the show form an pagination
        $result = $this->emailtemplate_m->getAll();
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'index.php/emailtemplate/index';
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
        $result = $this->emailtemplate_m->getAll($config['per_page'], $offset);
        $data['results'] = $result;
        $data['pagination_links'] = $this->pagination->create_links();
        $this->load->view('layout/frontend/header');
        $data['viewpath'] = 'emailtemplate_view/index';
        $data['data'] = '';
        $this->load->view('layout/frontend/content', $data);
        $this->load->view('layout/frontend/footer');
    }

    public function add() {
        //      check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }
        //insert
        $this->form_validation->set_rules($this->_validation_rules);
        $data['data'] = array();
        $data['data']['op'] = 'add';

        $input = $this->input->post();


        $user = $this->session->userdata('user');
        $input['user_id'] = $user['id'];

        if ($this->form_validation->run()) {
            var_dump($input['content']);
            die();
            if ($this->emailtemplate_m->insert_emailtemplate($input)) {
                redirect('/emailtemplate', 'refresh');
            }
        }
        $this->load->view('layout/frontend/header');
        $data['viewpath'] = 'emailtemplate_view/add_view';
        $this->load->view('layout/frontend/content', $data);
        $this->load->view('layout/frontend/footer');
    }

    public function edit($id = 0) {
        //check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }
        //update
        // afisezi view add_view
        $data = array();
        $data['op'] = 'edit/' . $id;
        $this->form_validation->set_rules($this->_validation_rules);
        if ($this->form_validation->run()) {
            $input = $this->input->post();
            $user = $this->session->userdata('user');
            $input['user_id'] = $user['id'];

            if ($this->emailtemplate_m->update_emailtemplate($id, $input)) {
                redirect('/emailtemplate', 'refresh');
            }
        }
        $data['data']['results'] = $this->emailtemplate_m->getOne($id);
        $this->load->view('layout/frontend/header');
        $data['viewpath'] = 'emailtemplate_view/add_view';
        $this->load->view('layout/frontend/content', $data);
        $this->load->view('layout/frontend/footer');
    }

    //delete 
    public function delete($id) {
        $this->emailtemplate_m->delete_emailtemplate($id);
        redirect('/emailtemplate', 'refresh');
    }

}
