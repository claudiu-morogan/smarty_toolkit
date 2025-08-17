<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_contacts extends CI_Migration {
	public function up() {
		// Ensure dbforge is loaded
		if (!isset($this->dbforge)) {
			$this->load->dbforge();
		}
		$fields = [
			'id' => [
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'user_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE
			],
			'linked_user_id' => [
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => 255
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null' => TRUE
			],
			'phone' => [
				'type' => 'VARCHAR',
				'constraint' => 50,
				'null' => TRUE
			],
			'is_shared' => [
				'type' => 'TINYINT',
				'constraint' => 1,
				'default' => 0
			],
			'shared_with' => [
				'type' => 'TEXT',
				'null' => TRUE
			],
			'created_at' => [
				'type' => 'DATETIME',
				'null' => TRUE
			],
			'updated_at' => [
				'type' => 'DATETIME',
				'null' => TRUE
			]
		];
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		if (!$this->dbforge->create_table('contacts', TRUE)) {
			show_error('Failed to create contacts table');
		}
	}

	public function down() {
		$this->dbforge->drop_table('contacts');
	}
}
