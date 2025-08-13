<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo_model extends CI_Model {
    public function get_all($user_id) {
        return $this->db->get_where('todos', ['user_id' => $user_id])->result();
    }
    public function get($id, $user_id) {
        return $this->db->get_where('todos', ['id' => $id, 'user_id' => $user_id])->row();
    }
    public function add($data) {
        // Accepts 'due_date' in $data if present
        return $this->db->insert('todos', $data);
    }
    public function update($id, $user_id, $data) {
        // Accepts 'due_date' in $data if present
        $this->db->where(['id' => $id, 'user_id' => $user_id]);
        return $this->db->update('todos', $data);
    }
    public function delete($id, $user_id) {
        $this->db->where(['id' => $id, 'user_id' => $user_id]);
        return $this->db->delete('todos');
    }
}
