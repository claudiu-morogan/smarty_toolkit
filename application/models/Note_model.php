<?php
class Note_model extends CI_Model {
    public function get_all($user_id) {
        return $this->db->where('user_id', $user_id)->order_by('created_at', 'desc')->get('notes')->result();
    }
    public function get($id, $user_id) {
        return $this->db->where(['id' => $id, 'user_id' => $user_id])->get('notes')->row();
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
