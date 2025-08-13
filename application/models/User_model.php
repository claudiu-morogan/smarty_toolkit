<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function register($data) {
        return $this->db->insert('users', $data);
    }
    public function login($username, $password) {
        $user = $this->db->get_where('users', ['username' => $username])->row();
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }
    public function get_by_id($id) {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    // Get user preferences as array
    public function get_preferences($user_id) {
        $user = $this->get_by_id($user_id);
        if ($user && !empty($user->preferences)) {
            return json_decode($user->preferences, true);
        }
        return [];
    }

    // Set user preferences (array)
    public function set_preferences($user_id, $prefs) {
        $this->db->where('id', $user_id)->update('users', [
            'preferences' => json_encode($prefs)
        ]);
    }
}
