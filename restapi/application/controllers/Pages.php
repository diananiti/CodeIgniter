<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class pages extends CI_Controller {

    //validation
    private $_validation_rules = array(
        array(
            'field' => 'slug',
            'label' => 'slug',
            'rules' => 'trim|max_length[2048]|required'
        ), array(
            'field' => 'title',
            'label' => 'title',
            'rules' => 'trim|max_length[100]|required'
        ), array(
            'field' => 'content',
            'label' => 'content',
            'rules' => 'trim|max_length[2048]|required'
        )
    );

//  construct method
    function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('pages_m');
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
        $result = $this->pages_m->getAll();
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'index.php/pages/index';
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
        //echo $config['per_page'].'->'.$offset;
        $result = $this->pages_m->getAll($config['per_page'], $offset);
        $data['results'] = $result;
        //       echo $this->db->last_query();
        //       die();
        $data['pagination_links'] = $this->pagination->create_links();

        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'pages_view/pages_show';
        $data['data'] = '';

        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }

    public function check_slug($slug = '') {
        $slug = $this->input->get_post('slug');
        for ($i = 1; $i <= 100; $i++) {

            if (!$this->pages_m->exist_slug($slug)) {
                $i = 100;
                echo $slug;
            } else {
                $slug = $this->input->get_post('slug') . '_' . $i;
            }
        }
    }

    public function show_page_by_slug($slug = '') {
        $page = $this->pages_m->exist_slug($slug);
        if ($page) {
            echo $page;
        } else {
            echo 'there are no pages';
        }
        $data['page'] = $page;
        
        $data['viewpath'] = 'pages_view/slug_pages';
         $data['data'] = '';
           // var_dump($page);
             
        $this->load->view('layout/frontend/header');
        $this->load->view('layout/frontend/menu', $data);
        $this->load->view('layout/frontend/content', $data);
        $this->load->view('layout/frontend/footer');
    }

    public function add() {
        //      check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }

        //Insert new record in the database
        $this->form_validation->set_rules($this->_validation_rules);
        $data = array();
        $data['op'] = 'add';
        if ($this->form_validation->run()) {
            if ($this->pages_m->insert_pages($this->input->post()) != 0) {
                redirect('/pages', 'refresh');
            }
        }

        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'pages_view/pages_add';
        $data['data'] = '';

        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }

    public function edit($id = 0) {
        //      check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }

        //Update a record in the datebase
        $data = array();
        $data['op'] = 'edit/' . $id;
        $this->form_validation->set_rules($this->_validation_rules);
        if ($this->form_validation->run()) {
            if ($this->pages_m->update_pages($id, $this->input->post()) != 0) {
                redirect('/pages', 'refresh');
            }
        }

        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'pages_view/pages_add';
        $data['data'] = '';
        $data['results'] = $this->pages_m->getOne($id);
        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }

    public
            function delete($id) {
        $this->pages_m->delete($id);
        redirect('/pages', 'refresh');
    }

}
