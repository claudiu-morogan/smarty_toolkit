<?php
/**
 * Notes controller
 *
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property Note_model $Note_model
 */
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
        $this->load->library('form_validation');
        $user_id = $this->session->userdata('user_id');
        $this->load->model('Contact_model');
        $contacts = $this->Contact_model->get_all($user_id);
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('title', 'Title', 'required|trim|max_length[255]');
            $this->form_validation->set_rules('content', 'Content', 'required|trim');
            $this->form_validation->set_rules('contact_id', 'Contact', 'trim|integer');
            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'user_id' => $user_id,
                    'title' => $this->input->post('title', TRUE),
                    'content' => $this->input->post('content', TRUE),
                    'contact_id' => $this->input->post('contact_id') ?: null,
                ];
                $this->Note_model->add($data);
                redirect('notes');
            }
        }
        $this->load->view('notes/add', ['contacts' => $contacts]);
    }
    public function edit($id) {
        $user_id = $this->session->userdata('user_id');
        $note = $this->Note_model->get($id, $user_id);
        if (!$note) show_404();
        $this->load->model('Contact_model');
        $contacts = $this->Contact_model->get_all($user_id);
        $this->load->library('form_validation');
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('title', 'Title', 'required|trim|max_length[255]');
            $this->form_validation->set_rules('content', 'Content', 'required|trim');
            $this->form_validation->set_rules('contact_id', 'Contact', 'trim|integer');
            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'title' => $this->input->post('title', TRUE),
                    'content' => $this->input->post('content', TRUE),
                    'contact_id' => $this->input->post('contact_id') ?: null,
                ];
                $this->Note_model->update($id, $user_id, $data);
                redirect('notes');
            }
        }
        $this->load->view('notes/edit', ['note' => $note, 'contacts' => $contacts]);
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
