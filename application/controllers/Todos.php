<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todos extends CI_Controller {
    public function planner() {
        $user_id = $this->session->userdata('user_id');
        $todos = $this->Todo_model->get_all($user_id);
        // Group todos by due_date for the current week
        $week = [];
        $start = new DateTime('monday this week');
        for ($i = 0; $i < 7; $i++) {
            $week[$start->format('Y-m-d')] = [];
            $start->modify('+1 day');
        }
        foreach ($todos as $todo) {
            if ($todo->due_date && isset($week[$todo->due_date])) {
                $week[$todo->due_date][] = $todo;
            }
        }
        $data['todos'] = $week;
        $this->load->view('todos/planner', $data);
    }
    public function __construct() {
        parent::__construct();
        $this->load->model('Todo_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }
    public function index() {
        $user_id = $this->session->userdata('user_id');
        $data['todos'] = $this->Todo_model->get_all($user_id);
        $this->load->view('todos/index', $data);
    }
    public function add() {
        if ($this->input->method() === 'post') {
            $data = [
                'user_id' => $this->session->userdata('user_id'),
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'due_date' => $this->input->post('due_date') ?: null
            ];
            $this->Todo_model->add($data);
            redirect('todos');
        }
        $this->load->view('todos/add');
    }
    public function edit($id) {
        $user_id = $this->session->userdata('user_id');
        $todo = $this->Todo_model->get($id, $user_id);
        if (!$todo) show_404();
        if ($this->input->method() === 'post') {
            $data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'is_done' => $this->input->post('is_done') ? 1 : 0,
                'due_date' => $this->input->post('due_date') ?: null
            ];
            $this->Todo_model->update($id, $user_id, $data);
            redirect('todos');
        }
        $this->load->view('todos/edit', ['todo' => $todo]);
    }
    public function delete($id) {
        $user_id = $this->session->userdata('user_id');
        $this->Todo_model->delete($id, $user_id);
        redirect('todos');
    }
}
