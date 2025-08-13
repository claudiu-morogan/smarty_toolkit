<?php
class Habit_model extends CI_Model {
    public function get_all($user_id) {
        return $this->db->where('user_id', $user_id)->order_by('created_at', 'desc')->get('habits')->result();
    }
    public function get($id, $user_id) {
        return $this->db->where(['id' => $id, 'user_id' => $user_id])->get('habits')->row();
    }
    public function add($data) {
        return $this->db->insert('habits', $data);
    }
    public function update($id, $user_id, $data) {
        return $this->db->where(['id' => $id, 'user_id' => $user_id])->update('habits', $data);
    }
    public function delete($id, $user_id) {
        return $this->db->where(['id' => $id, 'user_id' => $user_id])->delete('habits');
    }
    public function get_completions($habit_id, $user_id) {
        return $this->db->where(['habit_id' => $habit_id, 'user_id' => $user_id])->order_by('date', 'desc')->get('habit_completions')->result();
    }
    public function add_completion($habit_id, $user_id, $date = null) {
        if (!$date) $date = date('Y-m-d');
        $row = $this->db->get_where('habit_completions', ['habit_id' => $habit_id, 'user_id' => $user_id, 'date' => $date])->row();
        if ($row) {
            $this->db->where('id', $row->id)->update('habit_completions', ['count' => $row->count + 1]);
        } else {
            $this->db->insert('habit_completions', [
                'habit_id' => $habit_id,
                'user_id' => $user_id,
                'date' => $date,
                'count' => 1
            ]);
        }
    }
}
