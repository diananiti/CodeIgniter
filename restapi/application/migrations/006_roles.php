<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Roles extends CI_Migration {

    public function up() {

       $roles=array(
            'id' => array(
                'type' => 'INT',
                'constraint' =>' 10',
                'unsigned' => TRUE,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'role' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'ratio' => array(
                'type' => 'DOUBLE',
                'constraint' => '2,2',
                'null' => TRUE
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
 $this->dbforge->add_field($roles);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('roles',TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('roles');
    }

}
