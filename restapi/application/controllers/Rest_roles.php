<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by .
 * User: Liviu
 * Date: 8/17/2015
 * Time: 7:28 PM
 */
require APPPATH . '/libraries/REST_Controller.php';

class Rest_roles extends REST_Controller {

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

        $this->load->model('roles_m');

        $this->load->library('form_validation');
    }

    public function roles_get() {
        $user = $this->session->userdata('user');

        if ($user) {
            // roles from a data store e.g. database
            $result = $this->roles_m->getAll();

//      Converts object $result->result() to array type
            $roles = json_decode(json_encode($result->result()), true);

            $id = $this->get('id');

            // If the id parameter doesn't exist return all the roles

            if ($id === NULL) {
                // Check if the roles data store contains roles (in case the database result returns NULL)
                if ($roles) {
                    // Set the response and exit
                    $this->response($roles, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                } else {
                    // Set the response and exit
                    $this->response([
                        'status' => FALSE,
                        'message' => 'No roles were found'
                            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }
            }

            // Find and return a single record for a particular role.

            $id = (string) $id;

            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the role from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $role = NULL;

            if (!empty($roles)) {
                foreach ($roles as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $role = $value;
                    }
                }
            }

            if (!empty($role)) {
                $this->set_response($role, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Role could not be found'
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Please login first!'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function roles_post() {

        if (!$this->session->userdata('user')) {
            $this->response([
                'status' => FALSE,
                'message' => 'Please login first!'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

        if ($this->input->post('action') == 'edit') {
            if (!$this->get('id')) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Select id!'
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }

            $result = $this->roles_m->getAll();

//      Converts object $result->result() to array type
            $roles = json_decode(json_encode($result->result()), true);

            $id = (string) $this->get('id');
            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the role from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $message['role'] = NULL;

            if (!empty($roles)) {
                foreach ($roles as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $message['role'] = $value;
                    }
                }
            }

            if (empty($message['role'])) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Role could not be found'
                        ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $this->form_validation->set_rules($this->_roles_validation_rules);
            $this->form_validation->run();

            $input = $this->input->post();

            if (validation_errors()) {
                $message['errors'] = array(
                    'role' => form_error(role),
                    'ratio' => form_error(ratio)
                );
                $this->response($message);
            } else {
                $this->roles_m->update_role($id, $input);
                $this->response("Role with id $id successfuly updated!");
            }
        } else {

            if ($this->input->post('action') == 'add') {
                $this->form_validation->set_rules($this->_roles_validation_rules);
                $this->form_validation->run();

                $input = $this->input->post();

                if (validation_errors()) {
                    $message['errors'] = array(
                        'role' => form_error(role),
                        'ratio' => form_error(ratio)
                    );
                    $this->set_response($message);
                } else {
                    $this->roles_m->insert_role($input);
                    $this->set_response("New role created!");
                }
            } else {
                $this->response("Invalid action. Only edit and add available");
            }
        }
    }

    public function roles_delete() {
        if (!$this->session->userdata('user')) {
            $this->response([
                'status' => FALSE,
                'message' => 'Please login first!'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

        $id = (string) $this->get('id');

        if (!$id) {
            $this->response([
                'status' => FALSE,
                'message' => 'Select id!'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

        $this->roles_m->delete_role($id);

        $this->response("Role with id $id successfuly deleted!");
    }

}
