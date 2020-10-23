<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by .
 * User: Liviu
 * Date: 8/17/2015
 * Time: 7:28 PM
 */
require APPPATH . '/libraries/REST_Controller.php';

class Rest_vote extends REST_Controller {

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

    function __construct() {
        parent::__construct();
        // Configure limits on our controller methods
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key

        $this->load->model('vote_m');

        $this->load->library('form_validation');
    }

    public function vote_get() {
        $user = $this->session->userdata('user');

        if ($user) {
            // votes from a data store e.g. database
            $result = $this->vote_m->getAll();

//      Converts object $result->result() to array type
            $votes = json_decode(json_encode($result->result()), true);

            $id = $this->get('id');

            // If the id parameter doesn't exist return all the votes

            if ($id === NULL) {
                // Check if the votes data store contains votes (in case the database result returns NULL)
                if ($votes) {
                    // Set the response and exit
                    $this->response($votes, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                } else {
                    // Set the response and exit
                    $this->response([
                        'status' => FALSE,
                        'message' => 'No votes were found'
                            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }
            }

            // Find and return a single record for a particular vote.

            $id = (string) $id;

            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the vote from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $vote = NULL;

            if (!empty($votes)) {
                foreach ($votes as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $vote = $value;
                    }
                }
            }

            if (!empty($vote)) {
                $this->set_response($vote, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Vote could not be found'
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Please login first!'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function vote_post() {

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

            $result = $this->vote_m->getAll();

//      Converts object $result->result() to array type
            $votes = json_decode(json_encode($result->result()), true);

            $id = (string) $this->get('id');
            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the vote from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $message['vote'] = NULL;

            if (!empty($votes)) {
                foreach ($votes as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $message['vote'] = $value;
                    }
                }
            }

            $this->form_validation->set_rules($this->_vote_validation_rules);
            $this->form_validation->run();

            $input = $this->input->post();
            $input['user_id'] = $message['vote']['users_id'];

            if (validation_errors()) {
                $message['errors'] = array(
                    'artist_id' => form_error(artist_id),
                    'vote' => form_error(vote),
                    'comment' => form_error(comment)
                );
            } else {
                $this->vote_m->update_vote($id, $input);
                $this->response("Vote with id $id successfuly updated!");
            }

            if (!empty($message['vote'])) {
                $this->set_response($message, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Vote could not be found'
                        ], REST_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            if ($this->input->post('action') == 'add') {
                $this->form_validation->set_rules($this->_vote_validation_rules);
                $this->form_validation->run();

                $input = $this->input->post();

                $user = $this->session->userdata('user');
                $input['users_id'] = $user['id'];

                if (validation_errors()) {
                    $message['errors'] = array(
                        'artist_id' => form_error(artist_id),
                        'vote' => form_error(vote),
                        'comment' => form_error(comment)
                    );
                    $this->set_response($message);
                } else {
                    $id = $this->vote_m->insert_vote($input);
                    $this->set_response("New vote created!");
                }
            } else {
                $this->response("Invalid action. Only edit and add available");
            }
        }
    }

    public function vote_delete() {
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

        $this->vote_m->delete_vote($id);

        $this->response("Vote with id $id successfuly deleted!");
    }

}
