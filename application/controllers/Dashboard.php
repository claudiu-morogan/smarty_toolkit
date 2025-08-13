<?php
class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Todo_model');
        $this->load->model('Debt_model');
        $this->load->model('Habit_model');
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
    $data['habits'] = $this->Habit_model->get_all($user_id);
        $today = date('Y-m-d');
        $habits_today = array();
        foreach ($data['habits'] as $habit) {
            $completions = $this->Habit_model->get_completions($habit->id, $user_id);
            $today_completion = null;
            foreach ($completions as $c) {
                if ($c->date == $today) {
                    $today_completion = $c;
                    break;
                }
            }
            $habits_today[$habit->id] = $today_completion;
        }
        $data['habits_today'] = $habits_today;
        $this->load->view('dashboard/index', $data);
    }

    // Mark a todo as completed from dashboard
    public function mark_done($id) {
        $user_id = $this->session->userdata('user_id');
        $todo = $this->Todo_model->get($id, $user_id);
        if ($todo) {
            $this->Todo_model->update($id, $user_id, ['is_done' => 1]);
        }
        redirect('dashboard');
    }

    // Mark a habit as completed for today from dashboard
    public function mark_habit($id) {
    $user_id = $this->session->userdata('user_id');
    $this->Habit_model->add_completion($id, $user_id);
    redirect('dashboard');
    }
}
