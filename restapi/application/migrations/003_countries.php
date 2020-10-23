<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Countries extends CI_Migration {

    public function up() {
        $countries=array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                //'unsigned' => TRUE,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'country' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'continent_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE,
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
 $this->dbforge->add_field($countries);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('countries',TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('countries');
    }

}
