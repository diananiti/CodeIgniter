 

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Pages extends CI_Migration {

    public function up() {

        $pages=array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'null' => FALSE,
//                'auto_increment' => TRUE
            ),
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'content' => array(
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
            ),
        ); $this->dbforge->add_field($pages);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('pages',TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('pages');
    }

}
