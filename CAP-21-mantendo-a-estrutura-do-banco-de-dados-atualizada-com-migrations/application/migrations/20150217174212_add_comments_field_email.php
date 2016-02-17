<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_comments_field_email extends CI_Migration {

  public function up()
  {
    $this->dbforge->add_column('comments', array(
      'email' => array(
              'type' => 'VARCHAR',
              'constraint' => '100',
      )
    ));
  }

  public function down()
  {
    $this->dbforge->drop_column('comments', 'email');
  }
}
