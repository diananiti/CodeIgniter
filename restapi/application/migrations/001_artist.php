<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Artist extends CI_Migration {

    public function up() {

        $artist = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                //'unsigned' => TRUE,
                'null' => FALSE,
                'auto_increment' => TRUE
               
            ),
            'fullname' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ),
            'genre_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE
            ),
             'style_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE
            ),
             'substyle_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE
            ),
             'country_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE
            ),
             'date_of_birth' => array(
                'type' => 'DATE',
                'null' => TRUE
            ),
           
            'bio' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'vote' => array(
                'type' => 'DOUBLE',
                 'constraint' => '10,0',
                'null' => TRUE
            ),
            'artworks' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE
            ),
            'avatar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
                
            ),
             'users_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE
            )
            );
        
        $this->dbforge->add_field($artist);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('artist',TRUE);
        
    }

        public function down() {
            $this->dbforge->drop_table('artist');
        }
}