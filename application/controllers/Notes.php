<?php
class Notes extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Note_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }
    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['notes'] = $this->Note_model->get_all($user_id);
        $this->load->view('notes/index', $data);
    }
    public function add() {
        if ($this->input->method() === 'post') {
            $data = [
                'user_id' => $this->session->userdata('user_id'),
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
            ];
            $this->Note_model->add($data);
            redirect('notes');
        }
        $this->load->view('notes/add');
    }
    public function edit($id) {
        $user_id = $this->session->userdata('user_id');
        $note = $this->Note_model->get($id, $user_id);
        if (!$note) show_404();
        if ($this->input->method() === 'post') {
            $data = [
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
            ];
            $this->Note_model->update($id, $user_id, $data);
            redirect('notes');
        }
        $this->load->view('notes/edit', ['note' => $note]);
    }
    public function delete($id) {
        $user_id = $this->session->userdata('user_id');
        $this->Note_model->delete($id, $user_id);
        redirect('notes');
    }
    public function view($id) {
        $user_id = $this->session->userdata('user_id');
        $note = $this->Note_model->get($id, $user_id);
        if (!$note) show_404();
        $this->load->view('notes/view', ['note' => $note]);
    }
}
