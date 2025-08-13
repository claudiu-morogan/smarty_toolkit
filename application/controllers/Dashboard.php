<?php
class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Todo_model');
        $this->load->model('Debt_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }
    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['todos'] = $this->Todo_model->get_all($user_id);
        $data['debts'] = $this->Debt_model->get_all($user_id);
        $data['reminders'] = $this->Debt_model->get_reminders($user_id);
        $this->load->view('dashboard/index', $data);
    }
}
