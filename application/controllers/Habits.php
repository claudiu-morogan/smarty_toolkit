<?php
/**
 * Habits controller
 *
 * @property CI_Input $input
 * @property CI_Session $session
 * @property CI_Form_validation $form_validation
 * @property Habit_model $Habit_model
 */
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
        $this->load->library('form_validation');
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[255]');
            $this->form_validation->set_rules('description', 'Description', 'trim');
            $this->form_validation->set_rules('target', 'Target', 'required|integer|greater_than[0]');
            $this->form_validation->set_rules('period', 'Period', 'required|in_list[daily,weekly,monthly]');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'name' => $this->input->post('name', TRUE),
                    'description' => $this->input->post('description', TRUE),
                    'target' => $this->input->post('target', TRUE) ?: 1,
                    'period' => $this->input->post('period', TRUE) ?: 'daily',
                );
                $this->Habit_model->add($data);
                redirect('habits');
            }
        }
        $this->load->view('habits/add');
    }

    public function edit($id) {
        $user_id = $this->session->userdata('user_id');
        $habit = $this->Habit_model->get($id, $user_id);
        if (!$habit) show_404();
        $this->load->library('form_validation');
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[255]');
            $this->form_validation->set_rules('description', 'Description', 'trim');
            $this->form_validation->set_rules('target', 'required|integer|greater_than[0]');
            $this->form_validation->set_rules('period', 'required|in_list[daily,weekly,monthly]');
            if ($this->form_validation->run() === TRUE) {
                $data = array(
                    'name' => $this->input->post('name', TRUE),
                    'description' => $this->input->post('description', TRUE),
                    'target' => $this->input->post('target', TRUE) ?: 1,
                    'period' => $this->input->post('period', TRUE) ?: 'daily',
                );
                $this->Habit_model->update($id, $user_id, $data);
                redirect('habits');
            }
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
