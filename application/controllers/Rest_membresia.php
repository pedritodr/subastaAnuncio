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



    public function pagar_membresia_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        if ($auth) {
            $membresia = $this->input->post('membresia_id');

            $object_membresia = $this->membresia->get_by_id($membresia);
            $fecha = date('Y-m-d H:i:s');
            $fecha_fin = strtotime('+364 day', strtotime($fecha));
            $fecha_fin = date('Y-m-d H:i:s', $fecha_fin);
            $fecha_mes = strtotime('+30 day', strtotime($fecha));
            $fecha_mes = date('Y-m-d', $fecha_mes);
            $data = [
                'user_id' => $user_id,
                'membresia_id' => $membresia,
                'fecha_inicio' => $fecha,
                'fecha_fin' => $fecha_fin,
                'fecha_mes' => $fecha_mes,
                'anuncios_publi' => (int) $object_membresia->cant_anuncio,
                'qty_subastas' => (int) $object_membresia->qty_subastas,
                'estado' => 1,
                'mes' => 1
            ];
            $id =  $this->membresia->create_membresia_user($data);
            if ($id) {
                $membresia_user = $this->membresia->get_by_user_id($user_id);
                $this->response(['status' => 200, 'membresia_user' => $membresia_user]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function buscar_membresia_user_post()
    {

        $user_id = $this->input->post('user_id');

        $security_token = $this->input->post('security_token');
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        $this->response(['status' => 200, 'user_id' => $auth]);
        if ($auth) {
            $membresia_user = $this->membresia->get_by_user_id($user_id);
            if ($membresia_user) {
                $this->response(['status' => 200, 'membresia_user' => $membresia_user]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
}
