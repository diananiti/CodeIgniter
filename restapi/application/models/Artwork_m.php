<?php

defined('BASEPATH') or exit('No direct script access allowed');

class artwork_m extends CI_Model {

    private $_table = 'artwork';

    function __construct() {
        //function construct
        log_message('info', 'artwork_m');
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

    public function getAllArtworks() {
        $query = $this->db->query('SELECT artwork_id FROM artworkgallery');
        return $query;
    }

    public function ArtworksByCountries($country_id = 0) {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->join('artworkartist as artworkartist', 'artwork.id=artworkartist.artwork_id', 'left');
        $this->db->join('artist as artist', 'artworkartist.artist_id=artist.id', 'left');
        $this->db->join('countries', 'artist.country_id=countries.id', 'left');
        // where and send countries
        if ($country_id != 0){
            $this->db->where('countries.id',$country_id);
        }
        $query = $this->db->get();
       // $results = $query->result();
        return $query;
    }

    public function last5artworks($artistId = 0) {

        $this->db
                ->select('*')
                ->from($this->_table)
                ->join('artworkartist as artworkartist', 'artwork.id=artworkartist.artwork_id', 'left')
                ->join('artworkgallery as artworkgallery', 'artwork.id=artworkgallery.artwork_id', 'left')
                ->where('artworkartist.artist_id', $artistId);
        $this->db->limit('5');
        $query = $this->db->get();
        $results = $query->result();
        return $results;
    }

    public function allArtworks() {
        
    }

    public function lastArtworks($limit) {

        $this->db
                ->select('*')
                ->from($this->_table)
//                ->join('artworkartist as artworkartist', 'artwork.id=artworkartist.artwork_id', 'left')
                ->join('artworkgallery as artworkgallery', 'artwork.id=artworkgallery.artwork_id', 'left')
                ->where('artworkgallery.filename !=', NULL)
                ->order_by('id', 'RANDOM');
        $this->db->limit($limit);
        $query = $this->db->get();
        $results = $query->result();

        return $results;
    }

    function insert_artwork($input) {
        //insert pentru add
        $this->db->insert($this->_table, array(
            'user_id' => $input['user_id'],
            'slug' => $input['slug'],
            'title' => $input['title'],
            'content' => $input['content'],
            'datecreated' => gmdate('Y-m-d H:i:s'),
            'dateupdated' => gmdate('Y-m-d H:i:s'),
        ));

        return $this->db->insert_id();
    }

    function update_artwork($id, $input) {

        //metoda de update in model pentru edit
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
    public function delete_artwork($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->_table);
    }

    public function search_artwork($artwork) {
        $this->db
                ->select('*')
                ->from($this->_table)
                ->like('title', $artwork);

        $results = $this->db->get();
        return $results;
    }

}
