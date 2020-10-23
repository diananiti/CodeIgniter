<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_artworkartist extends CI_Migration {

    public function up() {

        $artworkartist = array(
            'id' => array(
                'type' => 'INT',
                'constraint' =>' 10',
                'unsigned' => TRUE,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '10',
                'null' => FALSE
            ),
            'artist_id' => array(
                'type' => 'INT',
                'constraint' => '10',
                'null' => FALSE
            ),
            'artwork_id' => array(
                'type' => 'INT',
                'constraint' => '10',
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
        $this->dbforge->add_field($artworkartist);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('artworkartist', TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('artworkartist');
    }

}
