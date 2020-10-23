<?php

defined('BASEPATH') or exit('No direct script access allowed');

class roles_m extends CI_Model {

    private $_table = 'roles';

    function __construct() {
        //Function construct
        log_message('info', 'roles_m');
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

    function insert_role($input) {
        //Function insert model for add form
        return $this->db->insert($this->_table, array(
                    'role' => $input['role'],
                    'ratio' => $input['ratio'],
                    'datecreated' => gmdate('Y-m-d H:i:s'),
                    'dateupdated' => gmdate('Y-m-d H:i:s'),
        ));
    }

    function update_role($id, $input) {

        //Function update model for edit form
        $this->db->where('id', $id);
        return $this->db->update($this->_table, array(
                    'role' => $input['role'],
                    'ratio' => $input['ratio'],
                    'dateupdated' => gmdate('Y-m-d H:i:s'),
        ));
    }

    //Function delete model for delete form
    public function delete_role($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->_table);
    }

}
