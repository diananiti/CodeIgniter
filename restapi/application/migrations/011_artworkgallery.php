<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_artworkgallery extends CI_Migration {

    public function up() {

        $artworkgallery = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'artwork_id' => array(
                'type' => 'INT',
                'constraint' => '10',
                'null' => FALSE
            ),
            'filename' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'path' =>
            array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'datecreated' => array(
                'type' => 'DATETIME',
                'null' => FALSE
            )
        );
        $this->dbforge->add_field($artworkgallery);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('artworkgallery', TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('artworkgallery');
    }

}
