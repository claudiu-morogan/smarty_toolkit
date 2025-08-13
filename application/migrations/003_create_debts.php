<?php
// Migration: Create debts table
class Migration_create_debts extends CI_Migration {
    public function up() {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ],
            'debtor_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
            'due_date' => [
                'type' => 'DATE',
                'null' => TRUE
            ],
            'is_paid' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'default' => 'CURRENT_TIMESTAMP'
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('debts');
    }
    public function down() {
        $this->dbforge->drop_table('debts');
    }
}
