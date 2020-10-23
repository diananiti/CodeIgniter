<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Style extends CI_Migration {

    public function up() {

       $style=array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '10',
               // 'unsigned' => TRUE,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'style' => array(
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
 $this->dbforge->add_field($style);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('style',TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('style');
    }

}
