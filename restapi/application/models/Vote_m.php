<?php

defined('BASEPATH') or exit('No direct script access allowed');

class vote_m extends CI_Model {

    private $_table = 'vote';

    function __construct() {
        //function construct
        log_message('info', 'vote_m');
    }

    public function getAll($limit = 0, $offset = 1) {
        //all records
        $this->db->select('vote.*,artist.fullname');
        $this->db->from($this->_table);
        $this->db->join('artist', 'vote.artist_id=artist.id', 'left');
        if ($limit != 0 && $offset != 1) {
            $this->db->limit($limit, $offset);
        }
        $results = $this->db->get();
        return $results;
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

    public function last5votes($id = 0) {

        $this->db
                ->select('vote.*')
                ->from($this->_table)
                ->join('artist as artist', 'vote.artist_id=artist.id', 'left')
                ->where('vote.artist_id', $id);
        $this->db->order_by('vote.id', 'DESC');
        $this->db->limit('5');
        $query = $this->db->get();
        $results = $query->result();
        return $results;
    }
public function getAllVotes(){
     $query = $this->db->query('SELECT vote FROM vote');
        return $query;
}
    public function getArtist($id = 0) {
        $this->db
                ->select('artist.id,artist.fullname,countries.country')
                ->from('artist');
        $this->db->join('countries', 'artist.country_id=countries.id', 'left');
        if ($id != 0) {
            $this->db->where('id', $id);
        }
        $rezult = $this->db->get();
        return $rezult;
    }

    function insert_vote($input) {
        //insert pentru add

        $user = $this->session->userdata('user');
        return $this->db->insert($this->_table, array(
                    'users_id' => $user['id'],
                    'artist_id' => $input['artist_id'],
                    'vote' => $input['vote'],
                    'comment' => $input['comment'],
//                    'flag' => 'new',
                    'datecreated' => gmdate('Y-m-d H:i:s'),
                    'dateupdated' => gmdate('Y-m-d H:i:s'),
        ));
    }

    function update_vote($id, $input) {

        $user = $this->session->userdata('user');
        //metoda de update in model pentru edit
        $this->db->where('id', $id);
        return $this->db->update($this->_table, array(
                    'users_id' => $user['id'],
                    'artist_id' => $input['artist_id'],
                    'vote' => $input['vote'],
                    'comment' => $input['comment'],
//                    'flag' => $input['flag'],
                    'dateupdated' => gmdate('Y-m-d H:i:s'),
        ));
    }

    //delete 
    public function delete_vote($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->_table);
    }

}
