<?php

defined('BASEPATH') or exit('No direct script access allowed');

class artworkartist_m extends CI_Model {

    private $_table = 'artworkartist';

    function __construct() {
        //function construct
        log_message('info', 'artwork_m');
    }

    public function getOne($artwork_id = '') {
        //function to get only one record
        $this->db
                ->select('artist_id')
                ->from($this->_table)
                ->where('artwork_id', $artwork_id);
        $query = $this->db->get();
        $results = $query->result();
        if (isset($results[0])) {
            return $results[0];
        } else {
            return $results;
        }
    }

    public function getArtists($id = 0) {
        $this->db
                ->select('id,fullname')
                ->from('artist');
        if ($id != 0) {
            $this->db->where('id', $id);
        }
        $rez = $this->db->get();
        return $rez;
    }

    public function checkArtist($artist_id, $artwork_id) {
        $this->db
                ->select('*')
                ->from($this->_table)
                ->where('artist_id', $artist_id)
                ->where('artwork_id', $artwork_id);

        $rez = $this->db->get();
        return $rez->result();
    }

    function insert_artworkartist($input) {
        //insert pentru add
        foreach ($input['artist_id'] as $artist_id) {
           // if (empty($this->checkArtist($artist_id, $input['artwork_id']))) {
                $this->db->insert($this->_table, array(
                    'user_id' => $input['user_id'],
                    'artist_id' => $artist_id,
                    'artwork_id' => $input['artwork_id'],
                    'datecreated' => gmdate('Y-m-d H:i:s'),
                    'dateupdated' => gmdate('Y-m-d H:i:s'),
                ));
            //}
        }
    }

    public function delete_artworkartist($artwork_id) {
        $this->db->where('artwork_id', $artwork_id);
        return $this->db->delete($this->_table);
    }

    public function findArtistByArtwork($artwork_id) {
        $this->db
                ->select('*')
                ->from($this->_table)
                ->where('artwork_id', $artwork_id);

        $results = $this->db->get();
        return $results->result();
    }

}
