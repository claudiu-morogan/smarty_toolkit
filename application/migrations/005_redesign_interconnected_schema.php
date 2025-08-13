<?php
// Migration: Redesign for interconnected modules (notes, habits, tags, attachments, links)
class Migration_redesign_interconnected_schema extends CI_Migration {
    public function up() {
        // Notes
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'title' => ['type' => 'VARCHAR', 'constraint' => 255],
            'content' => ['type' => 'TEXT'],
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
            'updated_at' => ['type' => 'DATETIME', 'null' => TRUE],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('notes', TRUE);

        // Habits
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'description' => ['type' => 'TEXT', 'null' => TRUE],
            'target' => ['type' => 'INT', 'constraint' => 11, 'default' => 1],
            'period' => ['type' => 'ENUM("daily","weekly","monthly")', 'default' => 'daily'],
            'created_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('habits', TRUE);

        // Habit Completions
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'habit_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'date' => ['type' => 'DATE'],
            'count' => ['type' => 'INT', 'constraint' => 11, 'default' => 1],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('habit_completions', TRUE);

        // Tags
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'name' => ['type' => 'VARCHAR', 'constraint' => 50],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tags', TRUE);

        // Attachments
        $this->dbforge->add_field([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'file_path' => ['type' => 'VARCHAR', 'constraint' => 255],
            'uploaded_at' => ['type' => 'DATETIME', 'default' => 'CURRENT_TIMESTAMP'],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('attachments', TRUE);

        // Linking tables
        $this->dbforge->add_field([
            'note_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'todo_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
        ]);
        $this->dbforge->create_table('note_todo', TRUE);

        $this->dbforge->add_field([
            'note_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'debt_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
        ]);
        $this->dbforge->create_table('note_debt', TRUE);

        $this->dbforge->add_field([
            'note_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'habit_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
        ]);
        $this->dbforge->create_table('note_habit', TRUE);

        $this->dbforge->add_field([
            'tag_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'note_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
        ]);
        $this->dbforge->create_table('tag_note', TRUE);

        $this->dbforge->add_field([
            'tag_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'todo_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
        ]);
        $this->dbforge->create_table('tag_todo', TRUE);

        $this->dbforge->add_field([
            'attachment_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
            'note_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE],
        ]);
        $this->dbforge->create_table('attachment_note', TRUE);
    }
    public function down() {
        $this->dbforge->drop_table('attachment_note', TRUE);
        $this->dbforge->drop_table('tag_todo', TRUE);
        $this->dbforge->drop_table('tag_note', TRUE);
        $this->dbforge->drop_table('note_habit', TRUE);
        $this->dbforge->drop_table('note_debt', TRUE);
        $this->dbforge->drop_table('note_todo', TRUE);
        $this->dbforge->drop_table('attachments', TRUE);
        $this->dbforge->drop_table('tags', TRUE);
        $this->dbforge->drop_table('habit_completions', TRUE);
        $this->dbforge->drop_table('habits', TRUE);
        $this->dbforge->drop_table('notes', TRUE);
    }
}
