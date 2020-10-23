<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by .
 * User: Liviu
 * Date: 8/17/2015
 * Time: 7:28 PM
 */
require APPPATH . '/libraries/REST_Controller.php';

class Rest_style extends REST_Controller {

    private $_style_validation_rules = array(
        array(
            'field' => 'style',
            'label' => 'Style',
            'rules' => 'trim|max_length[255]|required'
        ),
    );

    function __construct() {
        parent::__construct();
        // Configure limits on our controller methods
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key

        $this->load->model('style_m');

        $this->load->library('form_validation');
    }

    public function style_get() {
        $user = $this->session->userdata('user');

        if ($user) {
            // styles from a data store e.g. database
            $result = $this->style_m->getAll();

//      Converts object $result->result() to array type
            $styles = json_decode(json_encode($result->result()), true);

            $id = $this->get('id');

            // If the id parameter doesn't exist return all the styles

            if ($id === NULL) {
                // Check if the styles data store contains styles (in case the database result returns NULL)
                if ($styles) {
                    // Set the response and exit
                    $this->response($styles, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                } else {
                    // Set the response and exit
                    $this->response([
                        'status' => FALSE,
                        'message' => 'No styles were found'
                            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }
            }

            // Find and return a single record for a particular style.

            $id = (string) $id;

            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the style from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $style = NULL;

            if (!empty($styles)) {
                foreach ($styles as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $style = $value;
                    }
                }
            }

            if (!empty($style)) {
                $this->set_response($style, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Style could not be found'
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Please login first!'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function style_post() {

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

            $result = $this->style_m->getAll();

//      Converts object $result->result() to array type
            $styles = json_decode(json_encode($result->result()), true);

            $id = (string) $this->get('id');
            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the style from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $message['style'] = NULL;

            if (!empty($styles)) {
                foreach ($styles as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $message['style'] = $value;
                    }
                }
            }

            if (empty($message['style'])) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Style could not be found'
                        ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $this->form_validation->set_rules($this->_style_validation_rules);
            $this->form_validation->run();

            $input = $this->input->post();

            if (validation_errors()) {
                $message['errors'] = array(
                    'style' => form_error(style)
                );
                $this->response($message);
            } else {
                $this->style_m->update_style($id, $input);
                $this->response("Style with id $id successfuly updated!");
            }
        } else {

            if ($this->input->post('action') == 'add') {
                $this->form_validation->set_rules($this->_style_validation_rules);
                $this->form_validation->run();

                $input = $this->input->post();

                $user = $this->session->userdata('user');
                $input['user_id'] = $user['id'];

                if (validation_errors()) {
                    $message['errors'] = array(
                        'style' => form_error(style)
                    );
                    $this->set_response($message);
                } else {
                    $this->style_m->insert_style($input);
                    $this->set_response("New style created!");
                }
            } else {
                $this->response("Invalid action. Only edit and add available");
            }
        }
    }

    public function style_delete() {
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

        $this->style_m->delete_style($id);

        $this->response("Style with id $id successfuly deleted!");
    }

}
