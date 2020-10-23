
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class emailtemplate_m extends CI_Model {

    private $_table = 'emailtemplate';

    function __construct() {
// Call the Model constructor
        log_message('info', 'emailtemplate_m');
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
    public function insert_emailtemplate($input) {
        //insert for the  add function
        return $this->db->insert($this->_table, array(
                    'user_id' => $input['user_id'],
                    'slug' => $input['slug'],
                    'title' => $input['title'],
                    'content' => $input['content'],
                    'datecreated' => gmdate('Y-m-d H:i:s'),
                    'dateupdated' => gmdate('Y-m-d H:i:s'),
        ));
    }

    function update_emailtemplate($id, $input) {

        $this->db->where('id', $id);
        return $this->db->update($this->_table, array(
                    'user_id' => $input['user_id'],
                    'slug' => $input['slug'],
                    'title' => $input['title'],
                    'content' => $input['content'],
                    'dateupdated' => gmdate('Y-m-d H:i:s'),
        ));
    }

    //delete 
    public function delete_emailtemplate($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->_table);
    }

}
