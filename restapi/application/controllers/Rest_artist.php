<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by .
 * User: Liviu
 * Date: 8/17/2015
 * Time: 7:28 PM
 */
require APPPATH . '/libraries/REST_Controller.php';

class Rest_artist extends REST_Controller {

    private $_artist_validation_rules = array(
        array(
            'field' => 'fullname',
            'label' => 'Fullname',
            'rules' => 'trim|max_length[255]|required'
        ),
        array(
            'field' => 'vote',
            'label' => 'Vote',
            'rules' => 'trim|required|less_than[11]'
        ),
        array(
            'field' => 'artworks',
            'label' => 'Artworks',
            'rules' => 'trim|required|numeric'
        ),
        array(
            'field' => 'date_of_birth',
            'label' => 'Date of Birth',
            'rules' => 'trim|required'
        ),
        array(
            'field' => 'bio',
            'label' => 'Bio',
            'rules' => 'trim|max_length[255]'
        )
    );

    function __construct() {
        parent::__construct();
        // Configure limits on our controller methods
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key

        $this->load->model('artist_m');

        $this->load->library('form_validation');
    }

    public function artist_get() {
        $user = $this->session->userdata('user');

        if ($user) {
            // artists from a data store e.g. database
            $result = $this->artist_m->getAll();

//      Converts object $result->result() to array type
            $artists = json_decode(json_encode($result->result()), true);

            $id = $this->get('id');

            // If the id parameter doesn't exist return all the artists

            if ($id === NULL) {
                // Check if the artists data store contains artists (in case the database result returns NULL)
                if ($artists) {
                    // Set the response and exit
                    $this->response($artists, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                } else {
                    // Set the response and exit
                    $this->response([
                        'status' => FALSE,
                        'message' => 'No artists were found'
                            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }
            }

            // Find and return a single record for a particular artist.

            $id = (string) $id;

            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the artist from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $artist = NULL;

            if (!empty($artists)) {
                foreach ($artists as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $artist = $value;
                    }
                }
            }

            if (!empty($artist)) {
                $this->set_response($artist, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Artist could not be found'
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Please login first!'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function artist_post() {

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

            $result = $this->artist_m->getAll();

//      Converts object $result->result() to array type
            $artists = json_decode(json_encode($result->result()), true);

            $id = (string) $this->get('id');
            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the artist from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $message['artist'] = NULL;

            if (!empty($artists)) {
                foreach ($artists as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $message['artist'] = $value;
                    }
                }
            }

            if (empty($message['artist'])) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Artist could not be found'
                        ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $this->form_validation->set_rules($this->_artist_validation_rules);
            $this->form_validation->run();

//            $this->response(array('fullname' => form_error(fullname)));

            $input = $this->input->post();
            $input['users_id'] = $message['artist']['users_id'];

            if (validation_errors()) {
                $message['errors'] = array(
                    'fullname' => form_error(fullname),
                    'vote' => form_error(vote),
                    'artworks' => form_error(artworks),
                    'date_of_birth' => form_error(date_of_birth)
                );
                $this->response($message);
            } else {
                $this->artist_m->update_artist($id, $input);
                $this->response("Artist with id $id successfuly updated!");
            }
        } else {

            if ($this->input->post('action') == 'add') {
                $this->form_validation->set_rules($this->_artist_validation_rules);
                $this->form_validation->run();

                $input = $this->input->post();

                $user = $this->session->userdata('user');
                $input['user_id'] = $user['id'];

                if (validation_errors()) {
                    $message['errors'] = array(
                        'fullname' => form_error(fullname),
                        'vote' => form_error(vote),
                        'artworks' => form_error(artworks),
                        'date_of_birth' => form_error(date_of_birth)
                    );
                    $this->set_response($message);
                } else {
                    $id = $this->artist_m->insert_artist($input);
                    $this->set_response("New artist with id $id created!");
                }
            } else {
                $this->response("Invalid action. Only edit and add available");
            }
        }
    }

    public function artist_delete() {
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

        $this->artist_m->delete_artist($id);

        $this->response("Artist with id $id successfuly deleted!");
    }

}
