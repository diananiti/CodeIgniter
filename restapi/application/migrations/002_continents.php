<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_Continents extends CI_Migration {
public function up(){
    $continents=array(
        'id' => array(
            'type' => 'INT',
            'constraint' =>' 11',
           // 'unsigned' => TRUE,
            'null' => FALSE,
            'auto_increment' => TRUE
        ),
        'continent' => array(
            'type' => 'VARCHAR',
            'constraint' => '255',
            'null' => TRUE
        ),
        'datecreated' => array(
            'type' => 'DATETIME',
            'null' =>TRUE
        ),
        'dateupdated' => array(
            'type' => 'DATETIME',
            'null' => TRUE
        )
    );
  $this->dbforge->add_field($continents);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('continents',TRUE);
}
    
    public function down() {
        $this->dbforge->drop_table('continents');
    }
}