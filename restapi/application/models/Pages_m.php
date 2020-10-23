
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class pages_m extends CI_Model {

    private $_table = 'pages';

    function __construct() {
// Call the Model constructor
        log_message('info', 'pages_m');
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

    public function exist_slug($slug = '') {
        $this->db
                ->select('*')
                ->from($this->_table)
                ->where('slug', $slug);
        $query = $this->db->get();
        $results = $query->result();
        if (isset($results[0])) {
            return $results[0];
        } else {
            return $results;
        }
    }
    public function get_one_page_by_slug($slug=''){
       $this->db
                ->select('*')
                ->from($this->_table)
                ->where('slug', $slug);
        $query = $this->db->get();
        $results = $query->result();
        if (isset($results[0])) {
            return $results[0];
        } else {
            return $results;
        }   
    }

    //insert
    public function insert_pages($input) {
        //insert for the add function
        $user = $this->session->userdata('user'); //generate user_id from a session and memorize it into a variable

        return $this->db->insert($this->_table, array(
                    'user_id' => $user['id'],
                    'slug' => $input['slug'],
                    'title' => $input['title'],
                    'content' => $input['content'],
                    'datecreated' => gmdate('Y-m-d H:i:s'),
                    'dateupdated' => gmdate('Y-m-d H:i:s'),
        ));
    }

    function update_pages($id, $input) {
        //update method in model for edit
        $this->db->where('id', $id);
        return $this->db->update($this->_table, array(
                    'slug' => $input['slug'],
                    'title' => $input['title'],
                    'content' => $input['content'],
                    'dateupdated' => gmdate('Y-m-d H:i:s'),
        ));
    }

    //delete 
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->_table);
    }

}
