<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class roles extends CI_Controller {

    //Rules for roles add/update:
    private $_validation_rules = array(
        array(
            'field' => 'role',
            'label' => 'role',
            'rules' => 'trim|max_length[255]|required'
        ),
        array(
            'field' => 'ratio',
            'label' => 'ratio',
            'rules' => 'trim|less_than[1]|required'
        ),
    );

    function __construct() {
        parent::__construct();

        $this->load->model('roles_m');
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
        $result = $this->roles_m->getAll();
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'index.php/roles/index';
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
        $result = $this->roles_m->getAll($config['per_page'], $offset);
        $data['results'] = $result;
        //       echo $this->db->last_query();
        //       die();
        $data['pagination_links'] = $this->pagination->create_links();

        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'roles_view/index';
        $data['data'] = '';

        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
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
            if ($this->roles_m->insert_role($this->input->post()) != 0) {
                redirect('/roles', 'refresh');
            }
        }

        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'roles_view/add_view';
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
            if ($this->roles_m->update_role($id, $this->input->post()) != 0) {
                redirect('/roles', 'refresh');
            }
        }

        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'roles_view/add_view';
        $data['data'] = '';
        $data['results'] = $this->roles_m->getOne($id);
        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }

    public function delete($id) {
        //Delete a record in the database
        $this->roles_m->delete_role($id);
        redirect('/roles', 'refresh');
    }

}
