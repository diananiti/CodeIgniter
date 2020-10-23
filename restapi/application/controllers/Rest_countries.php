<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by .
 * User: Liviu
 * Date: 8/17/2015
 * Time: 7:28 PM
 */
require APPPATH . '/libraries/REST_Controller.php';

class Rest_countries extends REST_Controller {

    private $_countries_validation_rules = array(
        array(
            'field' => 'country',
            'label' => 'country',
            'rules' => 'trim|max_length[255]|required'
        ),
        array(
            'field' => 'continents_id',
            'label' => 'continents_id',
            'rules' => 'trim|max_length[255]|required'
        ),
    );

    function __construct() {
        parent::__construct();
        // Configure limits on our controller methods
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key

        $this->load->model('countries_m');

        $this->load->library('form_validation');
    }

    public function countries_get() {
        $user = $this->session->userdata('user');

        if ($user) {
            // countries from a data store e.g. database
            $result = $this->countries_m->getAll();

//      Converts object $result->result() to array type
            $countries = json_decode(json_encode($result->result()), true);

            $id = $this->get('id');

            // If the id parameter doesn't exist return all the countries

            if ($id === NULL) {
                // Check if the countries data store contains countries (in case the database result returns NULL)
                if ($countries) {
                    // Set the response and exit
                    $this->response($countries, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                } else {
                    // Set the response and exit
                    $this->response([
                        'status' => FALSE,
                        'message' => 'No countries were found'
                            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }
            }

            // Find and return a single record for a particular country.

            $id = (string) $id;

            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the country from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $country = NULL;

            if (!empty($countries)) {
                foreach ($countries as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $country = $value;
                    }
                }
            }

            if (!empty($country)) {
                $this->set_response($country, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Country could not be found'
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Please login first!'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function countries_post() {

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

            $result = $this->countries_m->getAll();

//      Converts object $result->result() to array type
            $countries = json_decode(json_encode($result->result()), true);

            $id = (string) $this->get('id');
            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the country from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $message['country'] = NULL;

            if (!empty($countries)) {
                foreach ($countries as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $message['country'] = $value;
                    }
                }
            }

            if (empty($message['country'])) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Country could not be found'
                        ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $this->form_validation->set_rules($this->_countries_validation_rules);
            $this->form_validation->run();

            $input = $this->input->post();

            if (validation_errors()) {
                $message['errors'] = array(
                    'country' => form_error(country),
                    'continents_id' => form_error(continents_id)
                );
                $this->response($message);
            } else {
                $this->countries_m->update_country($id, $input);
                $this->response("Country with id $id successfuly updated!");
            }
        } else {

            if ($this->input->post('action') == 'add') {
                $this->form_validation->set_rules($this->_countries_validation_rules);
                $this->form_validation->run();

                $input = $this->input->post();

                $user = $this->session->userdata('user');
                $input['user_id'] = $user['id'];

                if (validation_errors()) {
                    $message['errors'] = array(
                        'country' => form_error(country),
                        'continents_id' => form_error(continents_id)
                    );
                    $this->set_response($message);
                } else {
                    $id = $this->countries_m->insert_countries($input);
                    $this->set_response("New country created!");
                }
            } else {
                $this->response("Invalid action. Only edit and add available");
            }
        }
    }

    public function countries_delete() {
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
        ;
        $this->countries_m->delete($id);

        $this->response("Country with id $id successfuly deleted!");
    }

}
