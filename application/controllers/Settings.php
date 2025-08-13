<?php
class Settings extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(['url', 'form']);
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }
    public function index() {
        $user_id = $this->session->userdata('user_id');
        $prefs = $this->User_model->get_preferences($user_id);
        $theme = isset($prefs['theme']) ? $prefs['theme'] : $this->session->userdata('theme');
        if ($this->input->method() === 'post') {
            $theme = $this->input->post('theme');
            $prefs['theme'] = $theme;
            $this->User_model->set_preferences($user_id, $prefs);
            $this->session->set_userdata('theme', $theme); // apply immediately
            $data['success'] = 'Preferences updated!';
        }
        $data['theme'] = $theme;
        $data['theme_files'] = [
            1 => 'Blue Gradient',
            2 => 'Dark Mode',
            3 => 'Green Pastel',
            4 => 'Purple Dream',
            5 => 'Sunset Orange',
            6 => 'Aqua Blue',
            7 => 'Pink Candy',
            8 => 'Yellow Lemonade',
            9 => 'Teal Ocean',
            10 => 'Classic White',
        ];
        $this->load->view('settings/index', $data);
    }
}
