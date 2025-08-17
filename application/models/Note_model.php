<?php
class Note_model extends CI_Model {
    public function get_all($user_id) {
        $this->db->select('notes.*, contacts.name as contact_name');
        $this->db->from('notes');
        $this->db->where('notes.user_id', $user_id);
        $this->db->join('contacts', 'contacts.id = notes.contact_id', 'left');
        $this->db->order_by('notes.created_at', 'desc');
        return $this->db->get()->result();
    }
    public function get($id, $user_id) {
        $this->db->select('notes.*, contacts.name as contact_name');
        $this->db->from('notes');
        $this->db->where(['notes.id' => $id, 'notes.user_id' => $user_id]);
        $this->db->join('contacts', 'contacts.id = notes.contact_id', 'left');
        return $this->db->get()->row();
    }
    public function add($data) {
        return $this->db->insert('notes', $data);
    }
    public function update($id, $user_id, $data) {
        return $this->db->where(['id' => $id, 'user_id' => $user_id])->update('notes', $data);
    }
    public function delete($id, $user_id) {
        return $this->db->where(['id' => $id, 'user_id' => $user_id])->delete('notes');
    }
}
