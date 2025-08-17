<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model {
    protected $table = 'contacts';

    // Get all contacts owned by user or shared with user
    public function get_all($user_id) {
        $this->db->where('user_id', $user_id);
        $owned = $this->db->get($this->table)->result();

        $this->db->reset_query();
        $this->db->where('is_shared', 1);
        $this->db->like('shared_with', '"' . $user_id . '"'); // JSON encoded user id
        $shared = $this->db->get($this->table)->result();

        return array_merge($owned, $shared);
    }

    public function get($id, $user_id) {
        $this->db->where(['id' => $id, 'user_id' => $user_id]);
        return $this->db->get($this->table)->row();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function share_contact($contact_id, $user_id, $share_with_ids) {
        // Only owner can share
        $contact = $this->get($contact_id, $user_id);
        if (!$contact) return false;
        $shared_with = json_encode($share_with_ids);
        $this->db->where(['id' => $contact_id, 'user_id' => $user_id]);
        return $this->db->update($this->table, [
            'is_shared' => 1,
            'shared_with' => $shared_with,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function update($id, $data, $user_id) {
        $this->db->where(['id' => $id, 'user_id' => $user_id]);
        return $this->db->update($this->table, $data);
    }

    public function delete($id, $user_id) {
        $this->db->where(['id' => $id, 'user_id' => $user_id]);
        return $this->db->delete($this->table);
    }
}
