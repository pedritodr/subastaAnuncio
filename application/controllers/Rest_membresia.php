<?php
require(APPPATH . "libraries/REST_Controller.php");
require(APPPATH . "libraries/DatalabSecurity.php");
//require(APPPATH . "libraries/proveedores/AlignetWallet.php");
class Rest_membresia extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Membresia_model', 'membresia');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function listar_post()
    {

        $all_membresias = $this->membresia->get_all();
        if ($all_membresias) {
            $this->response(['status' => 200, 'membresias' => $all_membresias]);
        } else {
            $this->response(['status' => 500]);
        }
    }
}
