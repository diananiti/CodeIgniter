<?php

class Migration extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('migration');
    }

    public function index() {
        if (!$this->migration->latest()) {
            show_error($this->migration->error_string());
        } else {
            echo 'is ok';
        }
    }
}

