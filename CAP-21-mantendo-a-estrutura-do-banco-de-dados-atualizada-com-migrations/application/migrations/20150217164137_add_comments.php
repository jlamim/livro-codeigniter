<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_comments extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_field(array(
      'id' => array(
              'type' => 'INT',
              'constraint' => 10,
              'unsigned' => TRUE,
              'auto_increment' => TRUE
      ),
      'post_id' => array(
              'type' => 'INT',
              'constraint' => 5
      ),
      'name' => array(
              'type' => 'VARCHAR',
              'constraint' => '100',
      ),
      'comment' => array(
              'type' => 'MEDIUMTEXT',
              'null' => FALSE,
      ),
      'date' => array(
              'type' => 'DATETIME',
              'null' => FALSE,
      ),
    ));
    $this->dbforge->add_key('id', TRUE);
    $this->dbforge->create_table('comments');
  }

  public function down()
  {
    $this->dbforge->drop_table('comments');
  }
}
