<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Vote extends CI_Migration {

    public function up() {

        $vote = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '10',
                'unsigned' => TRUE,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'users_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE
            ),
            'artist_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => TRUE
            ),
            'vote' => array(
                'type' => 'DOUBLE',
                'constraint' => '4,2',
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
            ),
            'flag' => array(
                'type' => 'ENUM',
                'constraint' => "'new', 'aproved', 'reject'",
                'null' => FALSE
            )
        );
        $this->dbforge->add_field($vote);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('vote', TRUE);
    }

    public function down() {
        $this->dbforge->drop_table('vote');
    }

}
