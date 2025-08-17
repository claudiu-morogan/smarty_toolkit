<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth controller
 *
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property User_model $User_model
 */
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
        $this->load->library('form_validation');
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[3]|max_length[50]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'username' => $this->input->post('username', TRUE),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'email' => $this->input->post('email', TRUE)
                ];
                if ($this->User_model->register($data)) {
                    redirect('auth/login');
                } else {
                    $data['error'] = 'Registration failed';
                }
            } else {
                $data['error'] = validation_errors();
            }
        }
        $this->load->view('auth/register', isset($data) ? $data : NULL);
    }
    public function logout() {
        $this->session->unset_userdata('user_id');
        redirect('auth/login');
    }
}
