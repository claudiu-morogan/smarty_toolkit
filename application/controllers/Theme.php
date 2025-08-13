<?php
// application/controllers/Theme.php
class Theme extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }
    public function set($theme) {
        $allowed = range(1, 10);
        if (in_array($theme, $allowed)) {
            $CI =& get_instance();
            $CI->session->set_userdata('theme', $theme);
        }
        $ref = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
        redirect($ref ? $ref : 'todos');
    }
}
