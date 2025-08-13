<?php
// Migration: Add preferences column to users table
class Migration_add_user_preferences extends CI_Migration {
    public function up() {
        $fields = [
            'preferences' => [
                'type' => 'TEXT',
                'null' => TRUE,
                'after' => 'email'
            ]
        ];
        $this->dbforge->add_column('users', $fields);
    }
    public function down() {
        $this->dbforge->drop_column('users', 'preferences');
    }
}
