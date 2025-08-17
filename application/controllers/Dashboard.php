<?php
/**
 * Dashboard controller
 *
 * Handles the main dashboard view and quick actions.
 *
 * @property CI_Session $session
 * @property Todo_model $Todo_model
 * @property Debt_model $Debt_model
 * @property Habit_model $Habit_model
 * @property User_model $User_model
 */
class Dashboard extends CI_Controller {
    /**
     * Dashboard constructor. Loads models, session, and checks authentication.
     */
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

    /**
     * Dashboard main view. Loads summary data and user dashboard preferences.
     */
    public function index() {
        $user_id = $this->session->userdata('user_id');
    $data['todos'] = $this->Todo_model->get_all($user_id);
    $data['debts'] = $this->Debt_model->get_all($user_id);
    $data['reminders'] = $this->Debt_model->get_reminders($user_id);
    $data['habits'] = $this->Habit_model->get_all($user_id);
    $this->load->model('Contact_model', 'Contact_model');
    $data['contacts'] = $this->Contact_model->get_all($user_id);
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
        // User dashboard card/module preferences
        $this->load->model('User_model');
        $prefs = $this->User_model->get_preferences($user_id);
    $default_cards = ['todos'=>1,'debts'=>1,'notes'=>1,'habits'=>1,'calendar'=>1,'contacts'=>1];
        $data['dashboard_cards'] = isset($prefs['dashboard_cards']) ? $prefs['dashboard_cards'] : $default_cards;
        $this->load->view('dashboard/index', $data);
    }

    /**
     * Mark a todo as completed from dashboard
     */
    public function mark_done($id) {
        $user_id = $this->session->userdata('user_id');
        $todo = $this->Todo_model->get($id, $user_id);
        if ($todo) {
            $this->Todo_model->update($id, $user_id, ['is_done' => 1]);
        }
        redirect('dashboard');
    }

    /**
     * Mark a habit as completed for today from dashboard
     */
    public function mark_habit($id) {
    $user_id = $this->session->userdata('user_id');
    $this->Habit_model->add_completion($id, $user_id);
    redirect('dashboard');
    }
}
