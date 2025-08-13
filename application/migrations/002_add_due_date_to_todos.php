<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_due_date_to_todos extends CI_Migration {
    public function up() {
        $fields = array(
            'due_date' => array(
                'type' => 'DATE',
                'null' => TRUE
            )
        );
        $this->dbforge->add_column('todos', $fields);
    }
    public function down() {
        $this->dbforge->drop_column('todos', 'due_date');
    }
}
