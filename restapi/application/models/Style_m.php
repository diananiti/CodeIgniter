<?php

defined('BASEPATH') or exit('No direct script access allowed');

class style_m extends CI_Model {

    private $_table = 'style';

    function __construct() {
        //function construct
        log_message('info', 'style_m');
    }

    public function getAll($limit = 0, $offset = 1) {
        //all records
        $this->db->select('*');
        $this->db->from($this->_table);
        if ($limit != 0 && $offset != 1) {
            $this->db->limit($limit, $offset);
        }
        $results = $this->db->get();
        return $results;
    }
public function GetAllStyle()
 {
     $query = $this->db->query('SELECT style FROM style');
        return $query;
}
    public function getOne($id = '') {
        //function to get only one record
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

    function insert_style($input) {
        //insert pentru add
        return $this->db->insert($this->_table, array(
                    'style' => $input['style'],
                    'datecreated' => gmdate('Y-m-d H:i:s'),
                    'dateupdated' => gmdate('Y-m-d H:i:s'),
        ));
    }

    function update_style($id, $input) {

        //metoda de update in model pentru edit
        $this->db->where('id', $id);
        return $this->db->update($this->_table, array(
                    'style' => $input['style'],
                    'dateupdated' => gmdate('Y-m-d H:i:s'),
        ));
    }

    //delete 
    public function delete_style($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->_table);
    }

}
