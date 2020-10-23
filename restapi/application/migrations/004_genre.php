<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Genre extends CI_Migration {

    public function up() {
     $genre=array(
            'id' => array(
                'type' => 'INT',
                'constraint' =>' 10',
               // 'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
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
        );
        $this->dbforge->add_field($genre);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('genre',TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('genre');
    }

}
