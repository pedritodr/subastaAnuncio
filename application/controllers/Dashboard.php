<?php
require(APPPATH . "libraries/facebook/src/facebook.php");

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model', 'user');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();

        if (!in_array($this->session->userdata('role_id'), [1, 2, 3])) {
            $this->log_out();
            redirect('login');
        }
    }

    public function index()
    {
        if (in_array($this->session->userdata('role_id'), [1])) {
            $this->load_view_admin_g('dashboard/index_admin');
        }
    }
}
