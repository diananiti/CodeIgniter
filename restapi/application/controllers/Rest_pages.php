<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by .
 * User: Liviu
 * Date: 8/17/2015
 * Time: 7:28 PM
 */
require APPPATH . '/libraries/REST_Controller.php';

class Rest_pages extends REST_Controller {

    private $_pages_validation_rules = array(
       array(
            'field' => 'slug',
            'label' => 'slug',
            'rules' => 'trim|max_length[2048]|required'
        ), array(
            'field' => 'title',
            'label' => 'title',
            'rules' => 'trim|max_length[100]|required'
        ), array(
            'field' => 'content',
            'label' => 'content',
            'rules' => 'trim|max_length[2048]|required'
        )
    );

    function __construct() {
        parent::__construct();
        // Configure limits on our controller methods
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key

        $this->load->model('pages_m');

        $this->load->library('form_validation');
    }

    public function pages_get() {
        $user = $this->session->userdata('user');

        if ($user) {
            // pages from a data store e.g. database
            $result = $this->pages_m->getAll();

//      Converts object $result->result() to array type
            $pages = json_decode(json_encode($result->result()), true);

            $id = $this->get('id');

            // If the id parameter doesn't exist return all the pages

            if ($id === NULL) {
                // Check if the pages data store contains pages (in case the database result returns NULL)
                if ($pages) {
                    // Set the response and exit
                    $this->response($pages, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                } else {
                    // Set the response and exit
                    $this->response([
                        'status' => FALSE,
                        'message' => 'No pages were found'
                            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }
            }

            // Find and return a single record for a particular page.

            $id = (string) $id;

            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the page from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $page = NULL;

            if (!empty($pages)) {
                foreach ($pages as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $page = $value;
                    }
                }
            }

            if (!empty($page)) {
                $this->set_response($page, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Page could not be found'
                        ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        } else {
            $this->set_response([
                'status' => FALSE,
                'message' => 'Please login first!'
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function pages_post() {

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

            $result = $this->pages_m->getAll();

//      Converts object $result->result() to array type
            $pages = json_decode(json_encode($result->result()), true);

            $id = (string) $this->get('id');
            // Validate the id.
            if ($id <= 0) {
                // Invalid id, set the response and exit.
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the page from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $message['page'] = NULL;

            if (!empty($pages)) {
                foreach ($pages as $key => $value) {
                    if (isset($value['id']) && $value['id'] === $id) {
                        $message['page'] = $value;
                    }
                }
            }
            
            if (empty($message['page'])) {
                $this->response([
                    'status' => FALSE,
                    'message' => 'Page could not be found'
                        ], REST_Controller::HTTP_BAD_REQUEST);
            }

            $this->form_validation->set_rules($this->_pages_validation_rules);
            $this->form_validation->run();

            $input = $this->input->post();
            $input['user_id'] = $message['page']['user_id'];

            if (validation_errors()) {
                $message['errors'] = array(
                    'slug' => form_error(slug),
                    'title' => form_error(title),
                    'content' => form_error(content)
                );
                $this->response($message);
            } else {
                $this->pages_m->update_pages($id, $input);
                $this->response("Page with id $id successfuly updated!");
            }
            
        } else {

            if ($this->input->post('action') == 'add') {
                $this->form_validation->set_rules($this->_pages_validation_rules);
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
                    $id = $this->pages_m->insert_pages($input);
                    $this->set_response("New page created!");
                }
            } else {
                $this->response("Invalid action. Only edit and add available");
            }
        }
    }

    public function pages_delete() {
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

        $this->pages_m->delete($id);

        $this->response("Page with id $id successfuly deleted!");
    }

}
