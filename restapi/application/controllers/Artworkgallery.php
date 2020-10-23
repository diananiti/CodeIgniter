<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class artworkgallery extends CI_Controller
{

    //Rules for roles add/update:
    private $_validation_rules = array(
        array(
            'field' => 'image',
            'label' => 'image',
            'rules' => 'trim|required'
        ),
//        array(
//            'field' => 'path',
//            'label' => 'path',
//            'rules' => 'trim|max_length[255]|required'
//        ),
    );

    function __construct()
    {
        parent::__construct();

        $this->load->model('artworkgallery_m');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    public function index()
    {
        //      check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }

        //In index is the show form an pagination
        $result = $this->artworkgallery_m->getAll();
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'index.php/artworkgallery/index';
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
        $result = $this->artworkgallery_m->getAll($config['per_page'], $offset);
        $data['results'] = $result;
        //       echo $this->db->last_query();
        //       die();
        $data['pagination_links'] = $this->pagination->create_links();

        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'artworkgallery_view/index';
        $data['data'] = '';

        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }

    public function add()
    {
        //      check the session user data if exist the user and is logged in
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }

        $id = trim($this->uri->segment(3));

        //insert
        $this->form_validation->set_rules($this->_validation_rules);
        $data = array();
        $data['op'] = 'add/' . $id;
        $input = $this->input->post();

//      Initializate avatar if nothing is selected
        $input['filename'] = '';

        if (!is_dir('./artworkgallery/' . $id)) {// Tells whether the filename is a directory
            mkdir('./artworkgallery/' . $id);//Makes directory
        }
//      upload avatar
        $config['upload_path'] = './artworkgallery/' . $id;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;
//        $config['max_size'] = '100';
//        $config['max_width'] = '1024';
//        $config['max_height'] = '768';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload("image")) {
            $data['error'] = array('error' => $this->upload->display_errors());
        } else {

            $image = $this->upload->data();

            $input['artwork_id'] = $id;
            $input['filename'] = $image['file_name'];
            $input['path'] = "./artworkgallery/" . $id;
//            $input['path'] = './artworkgallery/';
            $data = array('upload_data' => $this->upload->data());


            $this->artworkgallery_m->insert_image($input);
            redirect('/artworkgallery', 'refresh');
        }

        $this->load->view('layout/admin/header');

        $data['viewpath'] = 'artworkgallery_view/add_view';
        $data['data'] = '';
        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }


    public function delete($id)
    {

        $results = $this->artworkgallery_m->getOne($id);

//      Delete avatar if it exists
        if ($results->filename) {
            unlink($results->path . '/' . $results->filename);
        }
//      Delete artworkgallery from db
        $this->artworkgallery_m->delete_image($id);
        redirect('/artworkgallery', 'refresh');
    }

}
