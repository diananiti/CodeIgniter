<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by .
 * User: Liviu
 * Date: 8/17/2015
 * Time: 7:28 PM
 */
require APPPATH . '/libraries/REST_Controller.php';

class Rest extends REST_Controller {

    private $_vote_validation_rules = array(
        array(
            'field' => 'artist_id',
            'label' => 'artist_id',
            'rules' => 'trim|max_length[255]|required'
        ),
        array(
            'field' => 'vote',
            'label' => 'vote',
            'rules' => 'trim|less_than[5.000001]|required'
        ),
        array(
            'field' => 'comment',
            'label' => 'comment',
            'rules' => 'trim|max_length[255]|required'
        ),
    );
    private $_artwork_validation_rules = array(
        array(
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'trim|max_length[255]|required'
        ),
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|max_length[255]|required'
        ),
        array(
            'field' => 'content',
            'label' => 'Content',
            'rules' => 'trim|required'
        ),
    );
    private $_roles_validation_rules = array(
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
        // Configure limits on our controller methods
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key

        $this->load->model('user_m');
        $this->load->model('artwork_m');
        $this->load->model('artworkartist_m');
        $this->load->model('vote_m');
        $this->load->model('roles_m');

        $this->load->library('form_validation');
    }

    public function users_get() {
        // Users from a data store e.g. database
        $result = $this->user_m->getAll();

//      Converts object $result->result() to array type
        $users = json_decode(json_encode($result->result()), true);

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL) {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users) {
                // Set the response and exit
                $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.

        $id = (string) $id;

        // Validate the id.
        if ($id <= 0) {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the user from the array, using the id as key for retreival.
        // Usually a model is to be used for this.

        $user = NULL;

        if (!empty($users)) {
            foreach ($users as $key => $value) {
                if (isset($value['id']) && $value['id'] === $id) {
                    $user = $value;
                }
            }
        }

        if (!empty($user)) {
            $this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function users_post() {

        if ($this->input->post('action') == 'login') {
            if ($this->session->userdata('user')) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Already logged in!'
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }

            if (!is_null($this->user_m->login($this->input->post('username'), $this->input->post('password')))) {
                $user = $this->session->userdata('user');

                $this->user_m->update_token($user['id'], md5(time()));
//            $this->user_m->delete_token($user['id']);

                $result = $this->user_m->getOne($user['id']);

//      Converts object $result->result() to array type
                $message = json_decode(json_encode($result), true);
            } else {
                $message = [
                    'error' => 'Username or password not found'
                ];
            }
        } else if ($this->input->post('action') == 'logout') {
            $user = $this->session->userdata('user');

            $this->user_m->delete_token($user['id']);
            $this->session->sess_destroy();
            $message = [
                'action' => 'Logged out'
            ];
        } else {
            $message = [
                'error' => 'Invalid action. Only login and logout available'
            ];
        }

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function users_delete() {
        $id = (int) $this->get('id');

        // Validate the id.
        if ($id <= 0) {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

}
