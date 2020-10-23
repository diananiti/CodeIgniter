<?php

defined('BASEPATH') or exit('No direct script access allowed');

class artist_m extends CI_Model {

    private $_table = 'artist';

    function __construct() {
        //function construct
        log_message('info', 'artist_m');
    }

    public function getAll($limit = 0, $offset = 1) {
        //all records
        $this->db->select('artist.*,genre.name as genre,style.style as style,countries.country as country,users.fullname as users');
        $this->db->from($this->_table);
        $this->db->join('genre', 'genre.id=artist.genre_id', 'left');
        $this->db->join('style', 'style.id=artist.style_id', 'left');
        $this->db->join('countries', 'countries.id=artist.country_id', 'left');
        $this->db->join('users', 'users.id=artist.users_id', 'left');

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
    public function getAllArtists()
    {
        $query = $this->db->query('SELECT fullname FROM artist');
        return $query;
        
        
    }
   

    public function getOneArtist($id = 0) {

        $this->db->select('artist.*,genre.name as genre,style.style as style,countries.country as country,users.fullname as users');
        $this->db->from($this->_table);
        $this->db->join('genre', 'genre.id=artist.genre_id', 'left');
        $this->db->join('style', 'style.id=artist.style_id', 'left');
        $this->db->join('countries', 'countries.id=artist.country_id', 'left');
        $this->db->join('users', 'users.id=artist.users_id', 'left');
        if ($id != 0) {
            $this->db->where('artist.id', $id);
        }
        $rez = $this->db->get();
        return $rez;
    }

    public function getGenre($id = 0) {
        $this->db
                ->select('id,name')
                ->from('genre');
        if ($id != 0) {
            $this->db->where('id', $id);
        }
        $rez = $this->db->get();
        return $rez;
    }

    public function getStyle($id = 0) {
        $this->db
                ->select('id,style')
                ->from('style');
        if ($id != 0) {
            $this->db->where('id', $id);
        }
        $rez = $this->db->get();
        return $rez;
    }

    public function getCountries($id = 0) {
        $this->db
                ->select('id,country')
                ->from('countries');
        if ($id != 0) {
            $this->db->where('id', $id);
        }
        $rez = $this->db->get();
        return $rez;
    }

    public function getUsers($id = 0) {
        $this->db
                ->select('id,fullname')
                ->from('users');
        if ($id != 0) {
            $this->db->where('id', $id);
        }
        $rez = $this->db->get();
        return $rez;
    }

    function insert_artist($input) {
        //insert pentru add
        return $this->db->insert($this->_table, array(
                    'fullname' => $input['fullname'],
                    'genre_id' => $input['genre_id'],
                    'style_id' => $input['style_id'],
                    'substyle_id' => $input['substyle_id'],
                    'country_id' => $input['country_id'],
                    'date_of_birth' => date('Y-m-d', strtotime($input['date_of_birth'])),
                    'bio' => $input['bio'],
                    'vote' => $input['vote'],
                    'artworks' => $input['artworks'],
                    'avatar' => $input['avatar'],
                    'users_id' => $input['users_id'],
        ));
    }

    function update_artist($id, $input) {

        //metoda de update in model pentru edit
        $this->db->where('id', $id);
        return $this->db->update($this->_table, array(
                    'fullname' => $input['fullname'],
                    'genre_id' => $input['genre_id'],
                    'style_id' => $input['style_id'],
                    'substyle_id' => $input['substyle_id'],
                    'country_id' => $input['country_id'],
                    'date_of_birth' => date('Y-m-d', strtotime($input['date_of_birth'])),
                    'bio' => $input['bio'],
                    'vote' => $input['vote'],
                    'artworks' => $input['artworks'],
                    'avatar' => $input['avatar'],
                    'users_id' => $input['users_id'],
        ));
    }

    //delete 
    public function delete_artist($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->_table);
    }

    public function search_artist($artist = '', $limit = '', $random = FALSE, $artists_id = []) {
        $this->db->select('artist.*,genre.name as genre,style.style as style,countries.country as country,users.fullname as users');
        $this->db->from($this->_table);
        $this->db->join('genre', 'genre.id=artist.genre_id', 'left');
        $this->db->join('style', 'style.id=artist.style_id', 'left');
        $this->db->join('countries', 'countries.id=artist.country_id', 'left');
        $this->db->join('users', 'users.id=artist.users_id', 'left');
        $this->db->like('artist.fullname', $artist);
        foreach($artists_id as $id){
            $this->db->or_where('artist.id', $id);
        }
        if ($limit) {
            $this->db->limit($limit);
        }
        if ($random == TRUE) {
            $this->db->order_by('id', 'RANDOM');
        }

        $results = $this->db->get();

        return $results->result();
    }

    public function search_artist_byId($artist_id) {
        $this->db->select('artist.*,genre.name as genre,style.style as style,countries.country as country,users.fullname as users');
        $this->db->from($this->_table);
        $this->db->join('genre', 'genre.id=artist.genre_id', 'left');
        $this->db->join('style', 'style.id=artist.style_id', 'left');
        $this->db->join('countries', 'countries.id=artist.country_id', 'left');
        $this->db->join('users', 'users.id=artist.users_id', 'left');
        $this->db->like('artist.id', $artist_id);

        $results = $this->db->get();

        return $results->result();
    }

}
