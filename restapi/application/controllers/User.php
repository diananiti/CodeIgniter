<?php

/**
 * Created by .
 * User: Liviu Iacob
 * Date: 8/8/2015
 * Time: 07:28
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {

    private $_validation_rules = array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|max_length[255]|required'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|max_length[255]|required'
        ),
    );
    private $_registration_rules = array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|max_length[255]|required|is_unique[users.username]'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|max_length[255]|required|alpha_numeric'
        ),
        array(
            'field' => 'password2',
            'label' => 'Password',
            'rules' => 'trim|max_length[255]|alpha_numeric|required|matches[password]'
        ),
        array(
            'field' => 'fullname',
            'label' => 'Name',
            'rules' => 'trim|max_length[255]|required'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|max_length[255]|required|is_unique[users.email]'
        ),
        array(
            'field' => 'checkbox',
            'label' => 'Checkbox',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'recaptcha',
            'label' => 'reCaptcha',
            'rules' => 'trim|callback_validate_recaptcha',
        ),
    );
    private $_validation_reset_password = array(
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|max_length[255]|required|alpha_numeric'
        ),
        array(
            'field' => 'confirmed_password',
            'label' => 'Confirmed password',
            'rules' => 'trim|max_length[255]|alpha_numeric|required|matches[password]'
        )
    );
    private $_validation_forgot_password = array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|max_length[255]|required'
        ),
    );

    function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('user_m');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->config->load('config');
        $this->load->model('vote_m');
        $this->load->model('artist_m');
        $this->load->model('artwork_m');
        $this->load->model('style_m');
        $this->load->model('countries_m');

        $this->load->model('pages_m');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('calendar');
        $this->load->library('form_validation');

        $this->load->helper('captcha');

        if ($this->session->userdata('site_lang')) {
            $language = $this->session->userdata('site_lang');
            $this->config->set_item('language', $language);
        }
    }

    public function validate_recaptcha() {
        if (!$this->input->post('g-recaptcha-response')) {
            $this->form_validation->set_message('validate_recaptcha', 'reCaptcha is not done!');
            return false;
        } else {
            return true;
        }
    }

    public function index() {
        // check the session user data if exist the user and is loggedin
        if (!$this->session->userdata('user')) {
            redirect('/user/login');
        }


////        ini_set('SMTP', "labs.boostit.net");
////        ini_set('smtp_port', 25);
//
//        $config['protocol'] = "smtp";
////        $config['mailpath'] = '/usr/sbin/sendmail';
////        $config['charset'] = 'iso-8859-1';
//        $config['wordwrap'] = TRUE;
//        $config['smtp_host'] = "localhost";
//        $config['mailtype'] = "text";
////
//        $this->email->initialize($config);
//
//        $this->email->from('andrei.popa014@gmail.com', 'Andrei Popa');
//        $this->email->to('dark.andrei@yahoo.com');
////            $this->email->cc('another@another-example.com');
////            $this->email->bcc('them@their-example.com');
//
//        $this->email->subject('BoostIT Academy account confirmation');
//        $this->email->message('Email Confirmation');
//
//        if($this->email->send()){
//            echo 'Mail sent successfuly';
//        }
//
//        echo $this->email->print_debugger();
//        die();
        $countries = $this->countries_m->getAll();
        $artworkcountry = array();
        foreach ($countries->result() as $country) {
            $artworkcountry[$country->country] = $this->artwork_m->ArtworksByCountries($country->id)->num_rows();
        }
        $percentage_atyle = $this->style_m->GetAllStyle();
        $percentage_users = $this->user_m->getAllUsers();
        $percentage_artist = $this->artist_m->getAllArtists();
        $percentage_artworks = $this->artwork_m->getAllArtworks();
        $percentage_votes = $this->vote_m->getAllVotes();
var_dump( $artworkcountry[$country->country]);
die;
        $data['data']['percentage_artist'] = $percentage_artist;
        $data['data']['percentage_artworks'] = $percentage_artworks;
        $data['data']['percentage_votes'] = $percentage_votes;
        $data['data']['percentage_users'] = $percentage_users;
        $data['data']['percentage_atyle'] = $percentage_atyle;

        $data['user'] = $this->session->userdata('user');
        $this->load->view('layout/admin/header');
        $data['viewpath'] = 'user/dashboard';

        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }

    public function login() {
        //      check the session user data if exist the user and is logged in
        if ($this->session->userdata('user')) {
            redirect('/user/index');
        }

        $this->form_validation->set_rules($this->_validation_rules);
        if ($this->form_validation->run()) {
            if (!is_null($this->user_m->login($this->input->post('username'), $this->input->post('password')))) {
                $this->session->userdata('user');
                redirect('/user/index');
            } else {
                $data['exist'] = "Username or Password not found!";
            }
        }

        $this->load->view('layout/admin/header');
        $data['data'] = '';
        $this->load->view('user/login', $data);
        $this->load->view('layout/admin/footer');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/user/index');
    }

    public function reset_password() {

        $hashtag = $this->uri->segment(3);
        if (strlen(trim($hashtag)) != 0) {
            $this->user_m->ByHashtag($hashtag);
            $this->form_validation->set_rules($this->_validation_reset_password);
            if ($this->form_validation->run()) {
                if (!is_null($this->user_m->update_hashtag($this->input->post('password'), $hashtag))) {
                    $this->session->userdata('user');
                    redirect('/user/index');
                }
            }
        }
        $this->load->view('layout/admin/header');
        //view path
        $data['viewpath'] = 'user/reset_password';
        $data['hashtag'] = $hashtag;
        $this->load->view('layout/admin/footer');
        $this->load->view('user/reset_password', $data);
    }

    public function registration() {
        //      check the session user data if exist the user and is logged in
        if ($this->session->userdata('user')) {
            redirect('/user/index');
        }

        $input = array(
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'fullname' => $this->input->post('fullname'),
        );

        $this->form_validation->set_rules($this->_registration_rules);

        if ($this->form_validation->run()) {
            $this->user_m->insert_user($input);
//      Login user after registration is compleate and successful
            $this->user_m->login($this->input->post('username'), $this->input->post('password'));
            $this->session->userdata('user');
            redirect('/user/index');
        }

        $this->load->view('layout/admin/header');
        //view path
        $data['input'] = $input;
        $this->load->view('user/registration', $data);
        $this->load->view('layout/admin/footer');
    }

    public function forgot_password() {
        $viewpath = 'user/forgot_password';
        $data = '';

        $this->form_validation->set_rules($this->_validation_forgot_password);
        if ($this->form_validation->run()) {
//      Check if login is succesfully and create session for the logged in user
            if (!is_null($this->user_m->forgot_password($this->input->post('email')))) {
                $data['hashtag'] = $this->user_m->getHashtag($this->input->post('email'));
                $viewpath = 'user/success';
            } else {
                $data['exist'] = "Email not found!";
            }
        }

        $this->load->view('layout/admin/header');
        $this->load->view($viewpath, $data);
        $this->load->view('layout/admin/footer');
    }

    public function user_profile() {
        $data['viewpath'] = 'user/profile';
        $data['data'] = '';

        $data['user'] = $this->user_m->getOne($this->session->userdata('user')['id']);

        $this->load->view('layout/admin/header');
        $this->load->view('layout/admin/content', $data);
        $this->load->view('layout/admin/footer');
    }

}
