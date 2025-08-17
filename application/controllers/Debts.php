<?php
/**
 * Debts controller
 *
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property Debt_model $Debt_model
 */
class Debts extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Debt_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }
    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['debts'] = $this->Debt_model->get_all($user_id);
        $data['reminders'] = $this->Debt_model->get_reminders($user_id);
        $this->load->view('debts/index', $data);
    }
    public function add() {
        $this->load->library('form_validation');
        $user_id = $this->session->userdata('user_id');
        // Load contacts for dropdown
        $this->load->model('Contact_model');
        $contacts = $this->Contact_model->get_all($user_id);
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('debtor_name', 'Debtor Name', 'required|trim|max_length[255]');
            $this->form_validation->set_rules('amount', 'Amount', 'required|numeric|greater_than[0]');
            $this->form_validation->set_rules('description', 'Description', 'trim');
            $this->form_validation->set_rules('due_date', 'Due Date', 'trim');
            $this->form_validation->set_rules('contact_id', 'Contact', 'trim|integer');
            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'user_id' => $user_id,
                    'debtor_name' => $this->input->post('debtor_name', TRUE),
                    'amount' => $this->input->post('amount', TRUE),
                    'description' => $this->input->post('description', TRUE),
                    'due_date' => $this->input->post('due_date', TRUE) ?: null,
                    'contact_id' => $this->input->post('contact_id') ?: null,
                    'is_paid' => 0
                ];
                $this->Debt_model->add($data);
                redirect('debts');
            }
        }
        $this->load->view('debts/add', ['contacts' => $contacts]);
    }
    public function edit($id) {
        $user_id = $this->session->userdata('user_id');
        $debt = $this->Debt_model->get($id, $user_id);
        if (!$debt) show_404();
        $this->load->model('Contact_model');
        $contacts = $this->Contact_model->get_all($user_id);
        $this->load->library('form_validation');
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('debtor_name', 'Debtor Name', 'required|trim|max_length[255]');
            $this->form_validation->set_rules('amount', 'Amount', 'required|numeric|greater_than[0]');
            $this->form_validation->set_rules('description', 'Description', 'trim');
            $this->form_validation->set_rules('due_date', 'Due Date', 'trim');
            $this->form_validation->set_rules('contact_id', 'Contact', 'trim|integer');
            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'debtor_name' => $this->input->post('debtor_name', TRUE),
                    'amount' => $this->input->post('amount', TRUE),
                    'description' => $this->input->post('description', TRUE),
                    'due_date' => $this->input->post('due_date', TRUE) ?: null,
                    'contact_id' => $this->input->post('contact_id') ?: null,
                    'is_paid' => $this->input->post('is_paid') ? 1 : 0
                ];
                $this->Debt_model->update($id, $user_id, $data);
                redirect('debts');
            }
        }
        $this->load->view('debts/edit', ['debt' => $debt, 'contacts' => $contacts]);
    }
    public function delete($id) {
        $user_id = $this->session->userdata('user_id');
        $this->Debt_model->delete($id, $user_id);
        redirect('debts');
    }
    public function mark_paid($id) {
        $user_id = $this->session->userdata('user_id');
        $this->Debt_model->update($id, $user_id, ['is_paid' => 1]);
        redirect('debts');
    }
}
