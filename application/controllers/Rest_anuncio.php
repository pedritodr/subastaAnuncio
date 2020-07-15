<?php
require(APPPATH . "libraries/REST_Controller.php");
require(APPPATH . "libraries/DatalabSecurity.php");
//require(APPPATH . "libraries/proveedores/AlignetWallet.php");
class Rest_anuncio extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('User_model', 'user');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }



    public function buscar_anuncios_filter_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $buscar = $this->input->post('buscar');
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        $comienza = $this->input->post('comienza');
        $ubicacion = $this->input->post('ubicacion');
        $ciudad = $this->input->post('ciudad');
        $this->response(['status' => 500, 'result' => $comienza]);
        $categoria = $this->input->post('categoria');
        $subcategoria = $this->input->post('subcategoria');
        $limite = 11;
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        $infinito = false;
        if ($comienza > 0) {
            $infinito = true;
        }

        if ($auth) {
            if ($ubicacion) {
                $ciudad_obj = $this->pais->get_city($ubicacion);
                if ($ciudad_obj) {
                    $ciudad = $ciudad_obj->ciudad_id;
                } else {
                    $ciudad = 0;
                }
            }

            $all_anuncios = $this->anuncio->search_by_name_pagination($limite, $comienza, $buscar, $ciudad, $categoria, $subcategoria);
            foreach ($all_anuncios as $item) {
                //     $item->titulo = str_replace("´", "", $item->titulo);
                $title = strlen($item->titulo);
                $long = strlen($item->descripcion);
                if ($long > 99) {
                    $item->corta = substr($item->descripcion, 0, 96) . "...";
                } else {
                    $item->corta = $item->descripcion;
                }
                if ($title > 19) {
                    $item->titulo = substr($item->titulo, 0, 16) . "...";
                } else {
                    $item->titulo = $item->titulo;
                }
            }

            if (count($all_anuncios) > 0) {


                $this->response(['status' => 200, 'lista' => $all_anuncios]);
            } else {
                $this->response(['status' => 404, 'infinito' => $infinito]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
}
