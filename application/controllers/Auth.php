<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
    }
    public function login() {
        if ($this->input->method() === 'post') {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->User_model->login($username, $password);
            if ($user) {
                $this->session->set_userdata(['user_id' => $user->id]);
                redirect('todos');
            } else {
                $data['error'] = 'Invalid credentials';
            }
        }
        $this->load->view('auth/login', isset($data) ? $data : NULL);
    }
    public function register() {
        if ($this->input->method() === 'post') {
            $data = [
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'email' => $this->input->post('email')
            ];
            if ($this->User_model->register($data)) {
                redirect('auth/login');
            } else {
                $data['error'] = 'Registration failed';
            }
        }
        $this->load->view('auth/register', isset($data) ? $data : NULL);
    }
    public function logout() {
        $this->session->unset_userdata('user_id');
        redirect('auth/login');
    }
}
