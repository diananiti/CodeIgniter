<?php

defined('BASEPATH') or exit('No direct script access allowed');

class user_m extends CI_Model {

    private $_salt = '';
    private $_table = 'users';

    function __construct() {
        //function construct
        log_message('info', 'user_m');
        $this->_salt = 'liviu';
    }

    public function getAll($limit = 0, $offset = 0) {
        //all records
        $this->db->select('*');
        $this->db->from($this->_table);
        if ($limit != 0 && $offset != 0) {
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

    public function getAllUsers() {
        $query = $this->db->query('SELECT username FROM users');
        return $query;
    }

    public function ByHashtag($hashtag = '') {

        $this->db
                ->select('*')
                ->from($this->_table)
                ->where('hashtag', $hashtag);
        $query = $this->db->get();
        $results = $query->result();
        if (isset($results[0])) {
            return $results[0];
        } else {
            return $results;
        }
    }

    function insert_user($input) {
        //insert pentru add
        return $this->db->insert($this->_table, array(
                    'username' => $input['username'],
                    'email' => $input['email'],
                    'password' => $this->encrypt_password($input['password'], true),
                    'fullname' => $input['fullname'],
                    'datelogin' => gmdate('Y-m-d H:i:s'),
                    'datecreated' => gmdate('Y-m-d H:i:s'),
                    'dateupdate' => gmdate('Y-m-d H:i:s'),
        ));
    }

    function update_token($id, $token) {
        $this->db->where('id', $id);
        return $this->db->update($this->_table, array(
                    'token' => $token
        ));
    }

    function update_hashtag($password, $hashtag) {
        $this->db->where('hashtag', $hashtag);
        return $this->db->update($this->_table, array(
                    'password' => $this->encrypt_password($password, true),
                    'hashtag' => NULL
        ));
    }

    function delete_token($id) {
        $this->db->where('id', $id);
        return $this->db->update($this->_table, array(
                    'token' => NULL
        ));
    }

    function update_user($id, $input) {

        //metoda de update in model pentru edit
        $this->db->where('id', $id);
        return $this->db->update($this->_table, array(
                    'username' => $input['username'],
                    'email' => $input['email'],
                    'password' => $this->encrypt_password($input['password'], true),
                    'fullname' => $input['fullname'],
                    'datelogin' => gmdate('Y-m-d H:i:s'),
                    'datecreated' => gmdate('Y-m-d H:i:s'),
                    'dateupdated' => gmdate('Y-m-d H:i:s'),
        ));
    }

    //delete 
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete($this->_table);
    }

    // function for the login

    public function login($username = '', $password = '') {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('username', $username);
        $this->db->where('password', $this->encrypt_password($password, TRUE));
        $this->encrypt_password($password, TRUE);
        $this->db->or_where('email', $username);
        $this->db->where('password', $this->encrypt_password($password, TRUE));
        $result = $this->db->get();
        if (!is_null($result->first_row())) {
            $user = $result->first_row();
            $this->setUserLogin($user);
            $this->update_last_login($user->id);
            return $user;
        } else {
            //return FALSE;
        }
    }

    private function setUserLogin($user) {
        $session_data = array(
            'id' => $user->id, //kept for backwards compatibility
            'roles_id' => $user->roles_id,
            'fullname' => $user->fullname,
            'username' => $user->username,
            'token' => $user->token,
        );

        $this->session->set_userdata('user', $session_data);
    }

    /*
     * function to update last login
     */

    public function update_last_login($id) {
        $this->db->update($this->_table, array('datelogin' => gmdate('Y-m-d H:i:s')), array('id' => $id));
    }

    /*
     * crypting the password
     */

    private function encrypt_password($password, $salt = false) {

        if (empty($password)) {
            return false;
        }
        if ($this->_salt && $salt) {
            return sha1($password . $salt);
        } else {
            return false;
        }
    }

    public function forgot_password($email = '') {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('email', $email);
//        $this->db->or_where('username', $email);
        $result = $this->db->get();
        if (!is_null($result->first_row())) {
            $this->db->where('email', $email);
            $this->db->update($this->_table, array(
                'hashtag' => uniqid('', TRUE),
            ));
            $user = $result->first_row();
            return $user;
        }
    }

    public function getHashtag($email = '') {
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('email', $email);
        $result = $this->db->get();
        if (!is_null($result->first_row())) {
            $user = $result->first_row();
            return $user->hashtag;
        }
    }

    public function change($user, $field, $input) {
        var_dump($user);
        var_dump($field);
        var_dump($input);
        $this->db
                ->select('*')
                ->from($this->_table)
                ->where('id', $user['id']);
//        if ($field == 'password') {
//            $this->db->update($this->_table, array('password' => $this->encrypt_password($input['password'], true)));
//        } else {
//            $this->db->update($this->_table, array($field => $input[$field]));
//        }
        die();
    }

}
