<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by .
 * User: Liviu
 * Date: 8/17/2015
 * Time: 7:28 PM
 */
require APPPATH . '/libraries/REST_Controller.php';

class Rest_artwork extends REST_Controller {

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

    function __construct() {
        parent::__construct();
        // Configure limits on our controller methods
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key

        $this->load->model('artwork_m');
        $this->load->model('artworkartist_m');

        $this->load->library('form_validation');
    }

    public function artwork_get() {
        $user = $this->session->userdata('user');

        if ($user) {
            // artworks from a data store e.g. database
            $result = $this->artwork_m->getAll();

//      Converts object $result->result() to array type
            $artworks = json_decode(json_encode($result->result()), true);

            $id = $this->get('id');

            // If the id parameter doesn't exist return all the artworks

            if ($id === NULL) {
                // Check if the artworks data store contains artworks (in case the database result returns NULL)
                if ($artworks) {
                    // Set the response and exit
                    $this->response($artworks, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                } else {
                    // Set the response and exit
                    $this->response([
                        'status' => FALSE,
                        'message' => 'No artworks were found'
                            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }
            }

            // Find and return a single record for a particular artwork.

            $id = (string) $id;

            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the artwork from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $artwork = NULL;

            if (!empty($artworks)) {
                foreach ($artworks as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $artwork = $value;
                    }
                }
            }

            if (!empty($artwork)) {
                $this->set_response($artwork, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Artwork could not be found'
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Please login first!'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function artwork_post() {

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

            $result = $this->artwork_m->getAll();

//      Converts object $result->result() to array type
            $artworks = json_decode(json_encode($result->result()), true);

            $id = (string) $this->get('id');
            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the artwork from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $message['artwork'] = NULL;

            if (!empty($artworks)) {
                foreach ($artworks as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $message['artwork'] = $value;
                    }
                }
            }
            
            if (empty($message['artwork'])) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Artwork could not be found'
                        ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $this->form_validation->set_rules($this->_artwork_validation_rules);
            $this->form_validation->run();

            $input = $this->input->post();
            $input['user_id'] = $message['artwork']['user_id'];

            if (validation_errors()) {
                $message['errors'] = array(
                    'slug' => form_error(slug),
                    'title' => form_error(title),
                    'content' => form_error(content)
                );
                $this->response($message);
            } else {
                $this->artwork_m->update_artwork($id, $input);
                $this->response("Artwork with id $id successfuly updated!");
            }
            
        } else {

            if ($this->input->post('action') == 'add') {
                $this->form_validation->set_rules($this->_artwork_validation_rules);
                $this->form_validation->run();

                $input = $this->input->post();

                $user = $this->session->userdata('user');
                $input['user_id'] = $user['id'];

                if (validation_errors()) {
                    $message['errors'] = array(
                        'slug' => form_error(slug),
                        'title' => form_error(title),
                        'content' => form_error(content)
                    );
                    $this->set_response($message);
                } else {
                    $id = $this->artwork_m->insert_artwork($input);
                    $this->set_response("New artwork with id $id created!");
                }
            } else {
                $this->response("Invalid action. Only edit and add available");
            }
        }
    }

    public function artwork_delete() {
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

        $this->artworkartist_m->delete_artworkartist($id);
        $this->artwork_m->delete_artwork($id);

        $this->response("Artwork with id $id successfuly deleted!");
    }

}
