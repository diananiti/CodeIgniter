<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_artwork extends CI_Migration {

    public function up() {

        $artwork = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'users_id' => array(
                'type' => 'INT',
                'constraint' => '10',
                'null' => FALSE
            ),
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'title' =>
            array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'comment' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
            'datecreated' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            ),
            'dateupdated' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            )
        );
        $this->dbforge->add_field($artwork);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('artwork', TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('artwork');
    }

}
