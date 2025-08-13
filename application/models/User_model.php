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
}
