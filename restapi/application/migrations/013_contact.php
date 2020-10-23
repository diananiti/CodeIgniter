<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Contact extends CI_Migration {

    public function up() {

        $contact = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                // 'unsigned' => TRUE,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE
            ),
            'message' => array(
                'type' => 'TEXT',
                'null' => FALSE
            ),
        );
        $this->dbforge->add_field($contact);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('contact', TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('contact');
    }

}
