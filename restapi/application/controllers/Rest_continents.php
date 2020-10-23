<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by .
 * User: Liviu
 * Date: 8/17/2015
 * Time: 7:28 PM
 */
require APPPATH . '/libraries/REST_Controller.php';

class Rest_continents extends REST_Controller {

    private $_continents_validation_rules = array(
        array(
            'field' => 'continent',
            'label' => 'continent',
            'rules' => 'trim|max_length[255]|required'
        ),
    );

    function __construct() {
        parent::__construct();
        // Configure limits on our controller methods
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key

        $this->load->model('continents_m');

        $this->load->library('form_validation');
    }

    public function continents_get() {
        $user = $this->session->userdata('user');

        if ($user) {
            // continents from a data store e.g. database
            $result = $this->continents_m->getAll();

//      Converts object $result->result() to array type
            $continents = json_decode(json_encode($result->result()), true);

            $id = $this->get('id');

            // If the id parameter doesn't exist return all the continents

            if ($id === NULL) {
                // Check if the continents data store contains continents (in case the database result returns NULL)
                if ($continents) {
                    // Set the response and exit
                    $this->response($continents, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                } else {
                    // Set the response and exit
                    $this->response([
                        'status' => FALSE,
                        'message' => 'No continents were found'
                            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }
            }

            // Find and return a single record for a particular continent.

            $id = (string) $id;

            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the continent from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $continent = NULL;

            if (!empty($continents)) {
                foreach ($continents as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $continent = $value;
                    }
                }
            }

            if (!empty($continent)) {
                $this->set_response($continent, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Continent could not be found'
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Please login first!'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function continents_post() {

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

            $result = $this->continents_m->getAll();

//      Converts object $result->result() to array type
            $continents = json_decode(json_encode($result->result()), true);

            $id = (string) $this->get('id');
            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the continent from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $message['continent'] = NULL;

            if (!empty($continents)) {
                foreach ($continents as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $message['continent'] = $value;
                    }
                }
            }

            if (empty($message['continent'])) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Continent could not be found'
                        ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $this->form_validation->set_rules($this->_continents_validation_rules);
            $this->form_validation->run();

            $input = $this->input->post();

            if (validation_errors()) {
                $message['errors'] = array(
                    'continent' => form_error(continent)
                );
                $this->response($message);
            } else {
                $this->continents_m->update_continents($id, $input);
                $this->response("Continent with id $id successfuly updated!");
            }
        } else {

            if ($this->input->post('action') == 'add') {
                $this->form_validation->set_rules($this->_continents_validation_rules);
                $this->form_validation->run();

                $input = $this->input->post();

                $user = $this->session->userdata('user');
                $input['user_id'] = $user['id'];

                if (validation_errors()) {
                    $message['errors'] = array(
                        'continent' => form_error(continent)
                    );
                    $this->set_response($message);
                } else {
                    $id = $this->continents_m->insert_continents($input);
                    $this->set_response("New continent created!");
                }
            } else {
                $this->response("Invalid action. Only edit and add available");
            }
        }
    }

    public function continents_delete() {
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

        $this->continents_m->delete_continents($id);

        $this->response("Continent with id $id successfuly deleted!");
    }

}
