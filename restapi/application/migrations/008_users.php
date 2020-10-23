<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Users extends CI_Migration {

    public function up() {

        $users = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                // 'unsigned' => TRUE,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'fullname' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'roles_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE,
            ),
            'token' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'datelogin' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'datecreated' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'dateupdated' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'avatar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
        );
        $this->dbforge->add_field($users);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users', TRUE);
    }

    public
            function down() {
        $this->dbforge->drop_table('users');
    }

}
