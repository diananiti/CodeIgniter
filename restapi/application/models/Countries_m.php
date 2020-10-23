
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class countries_m extends CI_Model {

    private $_table = 'countries'; //specify the table i work in

    function __construct() {
// Call the Model constructor
        log_message('info', 'countries_m');
    }

    public function getAll($limit = 0, $offset = 0) {
        $this->db
                ->select('countries.*,continents.continent');
        $this->db->from($this->_table);
        $this->db->join('continents', 'countries.continents_id=continents.id', 'left'); //it links the 2 of the tables

        if ($limit != 0 && $offset != 0) {
            $this->db->limit($limit, $offset);
        }
        $results = $this->db->get();
        // Return the results
        return $results;
    }

    public function get_one($id = '') {
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

    public function getContinents($id = 0) {
        $this->db
                ->select('id,continent')
                ->from('continents');
        if ($id != 0) {
            $this->db->where('id', $id);
        }
        $rez = $this->db->get();
        return $rez;
    }

    //insert
    public function insert_countries($input) {
        //insert for the add function

        return $this->db->insert($this->_table, array(
                    'country' => $input['country'],
                    'continents_id' => $input['continents_id'],
                    'datecreated' => gmdate('Y-m-d H:i:s'),
                    'dateupdated' => gmdate('Y-m-d H:i:s')
        ));
    }

    function update_country($id, $input) {

        $this->db->where('id', $id);
        return $this->db->update($this->_table, array(
                    'country' => $input['country'],
                    'continents_id' => $input['continents_id'],
                    'dateupdated' => gmdate('Y-m-d H:i:s')
                        )
        );
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->_table);
    }

}
