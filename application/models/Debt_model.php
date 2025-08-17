<?php
class Debt_model extends CI_Model {
    public function get_all($user_id) {
        $this->db->select('debts.*, contacts.name as contact_name');
        $this->db->from('debts');
        $this->db->where('debts.user_id', $user_id);
        $this->db->join('contacts', 'contacts.id = debts.contact_id', 'left');
        $this->db->order_by('debts.due_date', 'asc');
        return $this->db->get()->result();
    }
    public function get($id, $user_id) {
        $this->db->select('debts.*, contacts.name as contact_name');
        $this->db->from('debts');
        $this->db->where(['debts.id' => $id, 'debts.user_id' => $user_id]);
        $this->db->join('contacts', 'contacts.id = debts.contact_id', 'left');
        return $this->db->get()->row();
    }
    public function add($data) {
        return $this->db->insert('debts', $data);
    }
    public function update($id, $user_id, $data) {
        return $this->db->where(['id' => $id, 'user_id' => $user_id])->update('debts', $data);
    }
    public function delete($id, $user_id) {
        return $this->db->where(['id' => $id, 'user_id' => $user_id])->delete('debts');
    }
    public function get_reminders($user_id) {
        $today = date('Y-m-d');
        return $this->db->where('user_id', $user_id)
            ->where('is_paid', 0)
            ->where('due_date >=', $today)
            ->order_by('due_date', 'asc')
            ->get('debts')->result();
    }
}
