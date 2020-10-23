<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by .
 * User: Liviu
 * Date: 8/17/2015
 * Time: 7:28 PM
 */
require APPPATH . '/libraries/REST_Controller.php';

class Rest_genre extends REST_Controller {

    private $_genre_validation_rules = array(
        array(
            'field' => 'name',
            'label' => 'name',
            'rules' => 'trim|max_length[255]|required'
        ),
    );

    function __construct() {
        parent::__construct();
        // Configure limits on our controller methods
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key

        $this->load->model('genre_m');

        $this->load->library('form_validation');
    }

    public function genre_get() {
        $user = $this->session->userdata('user');

        if ($user) {
            // genre from a data store e.g. database
            $result = $this->genre_m->getAll();

//      Converts object $result->result() to array type
            $genre = json_decode(json_encode($result->result()), true);

            $id = $this->get('id');

            // If the id parameter doesn't exist return all the genre

            if ($id === NULL) {
                // Check if the genre data store contains genre (in case the database result returns NULL)
                if ($genre) {
                    // Set the response and exit
                    $this->response($genre, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                } else {
                    // Set the response and exit
                    $this->response([
                        'status' => FALSE,
                        'message' => 'No genre were found'
                            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }
            }

            // Find and return a single record for a particular genre.

            $id = (string) $id;

            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the genre from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $genre_data = NULL;

            if (!empty($genre)) {
                foreach ($genre as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $genre_data = $value;
                    }
                }
            }

            if (!empty($genre_data)) {
                $this->set_response($genre_data, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Genre could not be found'
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Please login first!'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function genre_post() {

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

            $result = $this->genre_m->getAll();

//      Converts object $result->result() to array type
            $genre = json_decode(json_encode($result->result()), true);

            $id = (string) $this->get('id');
            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the genre from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $message['genre_data'] = NULL;

            if (!empty($genre)) {
                foreach ($genre as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $message['genre_data'] = $value;
                    }
                }
            }

            if (empty($message['genre_data'])) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Genre could not be found'
                        ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $this->form_validation->set_rules($this->_genre_validation_rules);
            $this->form_validation->run();

            $input = $this->input->post();

            if (validation_errors()) {
                $message['errors'] = array(
                    'name' => form_error(name)
                );
                $this->response($message);
            } else {
                $this->genre_m->updateGenre($id, $input);
                $this->response("Genre with id $id successfuly updated!");
            }
        } else {

            if ($this->input->post('action') == 'add') {
                $this->form_validation->set_rules($this->_genre_validation_rules);
                $this->form_validation->run();

                $input = $this->input->post();

                if (validation_errors()) {
                    $message['errors'] = array(
                        'name' => form_error(name)
                    );
                    $this->set_response($message);
                } else {
                    $this->genre_m->insert_genre($input);
                    $this->set_response("New genre created!");
                }
            } else {
                $this->response("Invalid action. Only edit and add available");
            }
        }
    }

    public function genre_delete() {
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

        $this->genre_m->delete($id);

        $this->response("Genre with id $id successfuly deleted!");
    }

}
