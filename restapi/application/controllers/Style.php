<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class style extends CI_Controller {

    private $_validation_rules = array(
        array(
            'field' => 'style',
            'label' => 'Style',
            'rules' => 'trim|max_length[255]|required'
        ),
    );

    // metoda construct
    function __construct() {
        parent::__construct();

        $this->load->model('style_m');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index() {
        //      check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }

        $result = $this->style_m->getAll();
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'index.php/style/index';
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
        $result = $this->style_m->getAll($config['per_page'], $offset);
        $data['data']['results'] = $result;

        $data['data']['pagination_links'] = $this->pagination->create_links();
        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'style_view/index';

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
        $data['data']['op'] = 'add';
        if ($this->form_validation->run()) {
            if ($this->style_m->insert_style($this->input->post()) != 0) {
                redirect('/style', 'refresh');
            }
        }

        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'style_view/add_view';

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
            if ($this->style_m->update_style($id, $this->input->post()) != 0) {
                redirect('/style', 'refresh');
            }
        }

        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'style_view/add_view';
        $data['data'] = '';
        $data['results'] = $this->style_m->getOne($id);
        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }

    //delete 
    public function delete($id) {
        $this->style_m->delete_style($id);
        redirect('/style', 'refresh');
    }

}
