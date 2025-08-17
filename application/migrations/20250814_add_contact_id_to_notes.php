<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_contact_id_to_notes extends CI_Migration {
    public function up() {
        $fields = [
            'contact_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ]
        ];
        $this->dbforge->add_column('notes', $fields);
    }
    public function down() {
        $this->dbforge->drop_column('notes', 'contact_id');
    }
}
