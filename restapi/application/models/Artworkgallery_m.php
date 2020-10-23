<?php

defined('BASEPATH') or exit('No direct script access allowed');

class artworkgallery_m extends CI_Model {

    private $_table = 'artworkgallery';

    function __construct() {
        //function construct
        log_message('info', 'artworkgallery_m');
    }

    public function getAll($limit = 0, $offset = 1) {
        //Function to get all the records
        $this->db->select('*');
        $this->db->from($this->_table);
        if ($limit != 0 && $offset != 1) {
            $this->db->limit($limit, $offset);
        }
        $results = $this->db->get();
        return $results;
    }

    public function getOne($id = '') {
        //Function to get only one record
        $this->db
                ->select('*')
                ->from($this->_table)
                ->where('id', $id);
        $query = $this->db->get();
        $results = $query->result();
        if (isset($results[0])) {
            return $results[0];
        } else {
            return $results;
        }
    }

    function insert_image($input) {
        //Function insert model for add form
        return $this->db->insert($this->_table, array(
                    'artwork_id' => $input['artwork_id'],
                    'filename' => $input['filename'],
                    'path' => $input['path'],
                    'datecreated' => gmdate('Y-m-d H:i:s'),
        ));
    }

    public function delete_image($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->_table);
    }

}
