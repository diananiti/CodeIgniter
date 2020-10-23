<?php

/**
 * Created by .
 * User: liviu
 * Date: 01.09.2015
 * Time: 18:44
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class frontend extends CI_Controller {

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
    private $_login_rules = array(
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
    private $_validation_forgot_password = array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|max_length[255]|required'
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
    private $_change_password_rules = array(
        array(
            'field' => 'password_old',
            'label' => 'Current password',
            'rules' => 'trim|max_length[255]|required'
        ),
        array(
            'field' => 'password_new',
            'label' => 'New Password',
            'rules' => 'trim|max_length[255]|required'
        ),
        array(
            'field' => 'password_confirm',
            'label' => 'Confirm password',
            'rules' => 'trim|max_length[255]|required|matches[password]'
        ),
    );

    public function validate_recaptcha() {
        if (!$this->input->post('g-recaptcha-response')) {
            $this->form_validation->set_message('validate_recaptcha', 'reCaptcha is not done!');
            return false;
        } else {
            return true;
        }
    }

    function __construct() {
        parent::__construct();

        $this->load->library('pagination');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->config->load('config');
        $this->load->library('form_validation');
        $this->load->helper('captcha');

        $this->load->model('user_m');
        $this->load->model('artwork_m');
        $this->load->model('pages_m');
        $this->load->model('artist_m');
        $this->load->model('artwork_m');
        $this->load->model('artworkartist_m');

        if ($this->session->userdata('site_lang')) {
            $language = $this->session->userdata('site_lang');
            $this->config->set_item('language', $language);
        }

        $this->session->set_userdata('menu_pages', $this->pages_m->getAll()->result());
    }

    function index() {
        $data['data']['slide'] = $this->artwork_m->lastArtworks('3');
        $data['data']['gallery'] = $this->artwork_m->lastArtworks('15');

        $data['viewpath'] = 'homepage_view/index';

        $this->load->view('layout/frontend/header');
        $this->load->view('layout/frontend/content', $data);
        $this->load->view('layout/frontend/footer');
    }

    public function registration() {


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
            redirect('/');
        }

        $this->load->view('layout/frontend/header');
        //view path
        $data['data']['input'] = $input;
        $data['viewpath'] = 'user/frontend_registration';

        $this->load->view('layout/frontend/content', $data);
        $this->load->view('layout/frontend/footer');
    }

    public function forgot_password() {


        $input = array(
            'email' => $this->input->post('email'),
        );

        $this->form_validation->set_rules($this->_validation_forgot_password);

        if ($this->form_validation->run()) {

//      Check if login is succesfully and create session for the logged in user
            if (!is_null($this->user_m->forgot_password($this->input->post('email')))) {
                $data['hashtag'] = $this->user_m->getHashtag($this->input->post('email'));
                $viewpath = 'user/success';
            } else {
                $data['exist'] = "Email not found!";
                $viewpath = 'user/frontend_password';
            }
        }
        //  $this->user_m->insert_user($input);
        //$this->session->userdata('user');
        // redirect('/user/reset_password');

        $this->load->view('layout/frontend/header');
        $data['data']['input'] = $input;
        $data['viewpath'] = 'user/frontend_password';

        $this->load->view('layout/frontend/content', $data);
        $this->load->view('layout/frontend/footer');

        // $this->load->view('layout/frontend/header');
        //view path
        //$data['input'] = $input;
        // $this->load->view($viewpath, $data);
        // $this->load->view('layout/frontend/footer');
    }

    public function login() {
        //      check the session user data if exist the user and is logged in
        if ($this->session->userdata('user')) {
            redirect('/');
        }

        $this->form_validation->set_rules($this->_login_rules);
        if ($this->form_validation->run()) {
            if (!is_null($this->user_m->login($this->input->post('username'), $this->input->post('password')))) {
                $this->session->userdata('user');
                redirect('/');
            } else {
                $data['exist'] = "Username or Password not found!";
            }
        }

        $this->load->view('layout/frontend/header');
        //view path
        $data['data'] = '';
        $data['viewpath'] = 'user/frontend_login';

        $this->load->view('layout/frontend/content', $data);
        $this->load->view('layout/frontend/footer');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/');
    }

    public function artist_search($search = '') {
        $data['viewpath'] = 'artist_search/show_artist';
        $data['data'] = '';
        if ($this->artist_m->getAll()->num_rows() == 0) {
            $data['viewpath'] = 'artist_search/index';
            $data['data']['error'] = 'No records found. Please add some artists!';
        } else {

            if ($search) {
                $data['data']['search'] = $search;
//                $results = $this->artist_m->search_artist($search);
                $artists_id = array();

                if ($this->artwork_m->search_artwork($search)->num_rows() != 0) {
                    $artworks = $this->artwork_m->search_artwork($search)->result();
                    foreach ($artworks as $row) {
                        $artworkartist[] = $this->artworkartist_m->findArtistByArtwork($row->id);
                    }

                    foreach ($artworkartist as $artwork_id) {
                        foreach ($artwork_id as $row) {
                            $artists_id[] = $row->artist_id;
                        }
                    }
                }

                $results = $this->artist_m->search_artist($search, '', FALSE, $artists_id);

                if (empty($results)) {
                    $data['viewpath'] = 'artist_search/index';
                    $data['data']['error'] = 'No artist or artwork found. Please try again!';
                }

                $data['viewpath'] = 'artist_search/show_artist';
                $data['data']['results'] = $results;
                foreach ($results as $row) {
                    $data['data']['artworks'][$row->id] = $this->artwork_m->last5artworks($row->id);
                }
            } else {
                if (is_null($this->input->post('artist'))) {
                    $results = $this->artist_m->search_artist('', 3, TRUE);
                    $data['data']['results'] = $results;
                    foreach ($results as $row) {
                        $data['data']['artworks'][$row->id] = $this->artwork_m->last5artworks($row->id);
                    }
                } else {
                    $data['viewpath'] = 'artist_search/index';
                    $data['data']['error'] = 'No artist or artwork found. Please try again!';
                }
            }

            if ($this->input->post('artist')) {
                $results = $this->artist_m->search_artist($this->input->post('artist'));
                redirect('/search/' . $this->input->post('artist'));
            }
        }
        $this->load->view('layout/frontend/header');
        $this->load->view('layout/frontend/content', $data);
        $this->load->view('layout/frontend/footer');
    }

    public function reset_password() {

        $hashtag = $this->uri->segment(3);
        if (strlen(trim($hashtag)) != 0) {
            $this->user_m->ByHashtag($hashtag);
            $this->form_validation->set_rules($this->_validation_reset_password);
            if ($this->form_validation->run()) {
                if (!is_null($this->user_m->update_hashtag($this->input->post('password'), $hashtag))) {
                    $this->session->userdata('user');
                    redirect('/frontend/index');
                }
            }
        }

        $this->load->view('layout/frontend/header');
        //view path
        $data['data'] = '';
        $data['viewpath'] = 'user/frontend_reset_password';

        $this->load->view('layout/frontend/content', $data);
        $this->load->view('layout/frontend/footer');
    }

    public function user_profile($url = '') {
        if (!$this->session->userdata('user')) {
            redirect('/');
        }

        $data['viewpath'] = 'user/frontend_profile';

        if ($url) {
            $data['viewpath'] = 'user/change/' . $url;

            $this->form_validation->set_rules($this->_change_password_rules);

            $data['input'] = $this->input->post();

            if ($this->form_validation->run()) {

                $user = $this->session->userdata('user');
//                $input = array(
//                    $url => $this->input->post($url),
//                );
                $input = $this->input->post();
                var_dump($input);
                die();
//            $this->user_m->change($user, $url, $input);
            }
        }

        $data['data'] = '';

        $data['user'] = $this->user_m->getOne($this->session->userdata('user')['id']);

        $this->load->view('layout/frontend/header');
        $this->load->view('layout/frontend/content', $data);
        $this->load->view('layout/frontend/footer');
    }

}
