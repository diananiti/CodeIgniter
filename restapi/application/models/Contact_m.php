
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class contact_m extends CI_Model {

    private $_table = 'contact';

    function __construct() {
// Call the Model constructor
        log_message('info', 'contact_m');
    }
  public function getAll($limit = 0, $offset = 0) {
        $this->db
                ->select('*');
        $this->db->from($this->_table);
        if ($limit != 0 && $offset != 0) {
            $this->db->limit($limit, $offset);
        }
        $results = $this->db->get();
        // Return the results
        return $results;
    }

    public function getOne($id = '') {
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
    //insert
    public function insert_contact($input) {
        //insert for the  add function
        return $this->db->insert($this->_table, array(
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'message' => $input['message'],
        ));
    }

    function update_contact($id, $input) {
//pentru edit
        $this->db->where('id', $id);
        return $this->db->update($this->_table, array(
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'message' => $input['message'],
        ));
    }

    //delete 
    public function delete_contact($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->_table);
    }

}
