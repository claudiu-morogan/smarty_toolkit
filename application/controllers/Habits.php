<?php
class Habits extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Habit_model');
        $this->load->library('session');
        $this->load->helper(array('url', 'form'));
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['habits'] = $this->Habit_model->get_all($user_id);
        $this->load->view('habits/index', $data);
    }

    public function add() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'target' => $this->input->post('target') ?: 1,
                'period' => $this->input->post('period') ?: 'daily',
            );
            $this->Habit_model->add($data);
            redirect('habits');
        }
        $this->load->view('habits/add');
    }

    public function edit($id) {
        $user_id = $this->session->userdata('user_id');
        $habit = $this->Habit_model->get($id, $user_id);
        if (!$habit) show_404();
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'target' => $this->input->post('target') ?: 1,
                'period' => $this->input->post('period') ?: 'daily',
            );
            $this->Habit_model->update($id, $user_id, $data);
            redirect('habits');
        }
        $this->load->view('habits/edit', array('habit' => $habit));
    }

    public function delete($id) {
        $user_id = $this->session->userdata('user_id');
        $this->Habit_model->delete($id, $user_id);
        redirect('habits');
    }

    public function view($id) {
        $user_id = $this->session->userdata('user_id');
        $habit = $this->Habit_model->get($id, $user_id);
        if (!$habit) show_404();
        $completions = $this->Habit_model->get_completions($id, $user_id);
        $this->load->view('habits/view', array('habit' => $habit, 'completions' => $completions));
    }

    public function complete($id) {
        $user_id = $this->session->userdata('user_id');
        $this->Habit_model->add_completion($id, $user_id);
        redirect('habits/view/'.$id);
    }
}
