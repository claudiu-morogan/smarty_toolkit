<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Contact_model');
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper('url');
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }
    // Share contact with other users
    public function share($id) {
        $user_id = $this->session->userdata('user_id');
        $contact = $this->Contact_model->get($id, $user_id);
        if (!$contact) show_404();

        // Get all users except self
        $users = $this->User_model->get_all_except($user_id);

        $shared_with = [];
        $success = false;
        if ($this->input->post()) {
            $shared_with = $this->input->post('shared_with') ?: [];
            if (!empty($shared_with)) {
                $this->Contact_model->share_contact($id, $user_id, $shared_with);
                $success = true;
            }
        } else if ($contact->is_shared && $contact->shared_with) {
            $shared_with = json_decode($contact->shared_with, true);
        }

        $data = [
            'contact' => $contact,
            'users' => $users,
            'shared_with' => $shared_with,
            'success' => $success
        ];
        $this->load->view('contacts/share', $data);
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
    $data['contacts'] = $this->Contact_model->get_all($user_id);
        $this->load->view('contacts/index', $data);
    }

    public function add() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required|max_length[255]');
            $this->form_validation->set_rules('email', 'Email', 'valid_email|max_length[255]');
            $this->form_validation->set_rules('phone', 'Phone', 'max_length[50]');
            if ($this->form_validation->run()) {
                $data = [
                    'user_id' => $this->session->userdata('user_id'),
                    'linked_user_id' => $this->input->post('linked_user_id') ?: null,
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $this->Contact_model->insert($data);
                redirect('contacts');
            }
        }
        $this->load->view('contacts/add');
    }

    public function edit($id) {
        $user_id = $this->session->userdata('user_id');
    $contact = $this->Contact_model->get($id, $user_id);
        if (!$contact) show_404();
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Name', 'required|max_length[255]');
            $this->form_validation->set_rules('email', 'Email', 'valid_email|max_length[255]');
            $this->form_validation->set_rules('phone', 'Phone', 'max_length[50]');
            if ($this->form_validation->run()) {
                $data = [
                    'linked_user_id' => $this->input->post('linked_user_id') ?: null,
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            $this->Contact_model->update($id, $data, $user_id);
                redirect('contacts');
            }
        }
        $data['contact'] = $contact;
        $this->load->view('contacts/edit', $data);
    }

    public function delete($id) {
        $user_id = $this->session->userdata('user_id');
    $this->Contact_model->delete($id, $user_id);
        redirect('contacts');
    }
}
