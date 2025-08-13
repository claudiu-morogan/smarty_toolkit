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
        $start_page = isset($prefs['start_page']) ? $prefs['start_page'] : 'dashboard';
        $compact_mode = !empty($prefs['compact_mode']);
        $show_completed = isset($prefs['show_completed']) ? $prefs['show_completed'] : 1;
        $language = isset($prefs['language']) ? $prefs['language'] : 'en';

        if ($this->input->method() === 'post') {
            $theme = $this->input->post('theme');
            $start_page = $this->input->post('start_page');
            $compact_mode = $this->input->post('compact_mode') ? 1 : 0;
            $show_completed = $this->input->post('show_completed') ? 1 : 0;
            $language = $this->input->post('language');
            $prefs['theme'] = $theme;
            $prefs['start_page'] = $start_page;
            $prefs['compact_mode'] = $compact_mode;
            $prefs['show_completed'] = $show_completed;
            $prefs['language'] = $language;
            $this->User_model->set_preferences($user_id, $prefs);
            $this->session->set_userdata('theme', $theme); // apply immediately
            $data['success'] = 'Preferences updated!';
        }
        $data['theme'] = $theme;
        $data['start_page'] = $start_page;
        $data['compact_mode'] = $compact_mode;
        $data['show_completed'] = $show_completed;
        $data['language'] = $language;
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
