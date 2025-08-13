<?php
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
        if ($this->input->method() === 'post') {
            $data = [
                'user_id' => $this->session->userdata('user_id'),
                'debtor_name' => $this->input->post('debtor_name'),
                'amount' => $this->input->post('amount'),
                'description' => $this->input->post('description'),
                'due_date' => $this->input->post('due_date') ?: null,
                'is_paid' => 0
            ];
            $this->Debt_model->add($data);
            redirect('debts');
        }
        $this->load->view('debts/add');
    }
    public function edit($id) {
        $user_id = $this->session->userdata('user_id');
        $debt = $this->Debt_model->get($id, $user_id);
        if (!$debt) show_404();
        if ($this->input->method() === 'post') {
            $data = [
                'debtor_name' => $this->input->post('debtor_name'),
                'amount' => $this->input->post('amount'),
                'description' => $this->input->post('description'),
                'due_date' => $this->input->post('due_date') ?: null,
                'is_paid' => $this->input->post('is_paid') ? 1 : 0
            ];
            $this->Debt_model->update($id, $user_id, $data);
            redirect('debts');
        }
        $this->load->view('debts/edit', ['debt' => $debt]);
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
