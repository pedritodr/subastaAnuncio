<?php

class Membresia extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Membresia_model', 'membresia');
        $this->load->model('User_model', 'user');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $all_membresia = $this->membresia->get_all();
        $data['all_membresia'] = $all_membresia;
        $this->load_view_admin_g("membresia/index", $data);
    }
    public function asignar_membresia()
    {
        $user_id = $this->input->post('id_usuario');

        $membresia = $this->input->post('idmembresia');
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
        $valor = $this->membresia->create_membresia_user($data);
        //die(var_dump($valor));
        $this->response->set_message("Membresia asignada correctamente.", ResponseMessage::SUCCESS);
        redirect("user/detalles/" . $user_id);
        // $this->load_view_admin_g("user/cliente");

    }
    public function index_usuarios()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }
        $this->load->model('Pais_model', 'pais');
        $all_users = $this->membresia->get_all_membresias_users();
        foreach ($all_users as $item) {
            $item->ciudad = $this->pais->get_by_ciudad_id_object($item->ciudad_id);
        }

        $data['all_users'] = $all_users;
        $this->load_view_admin_g("membresia/index_usuario", $data);
    }


    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $this->load_view_admin_g('membresia/add');
    }


    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $nombre = $this->input->post('nombre');
        $precio = $this->input->post('precio');
        $cant_anuncio = $this->input->post('cant_anuncio');
        $descuento = $this->input->post('descuento');
        $sorteo = $this->input->post('sorteo');
        $descripcion = $this->input->post('descripcion');
        $subastas = $this->input->post('subastas');
        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');


        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("membresia/add_index", "location", 301);
        } else { //en caso de que todo este bien


            $data = [
                'nombre' => $nombre,
                'precio' => $precio,
                'cant_anuncio' => $cant_anuncio,
                'descuento' => $descuento,
                'sorteo' => $sorteo,
                'descripcion' => $descripcion,
                'qty_subastas' => $subastas
            ];
            $this->membresia->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("membresia/index");
        }
    }


    function update_index($membresia_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $membresia_object = $this->membresia->get_by_id($membresia_id);

        if ($membresia_object) {
            $data['membresia_object'] = $membresia_object;
            $this->load_view_admin_g('membresia/update', $data);
        } else {
            show_404();
        }
    }



    public function update()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $membresia_id = $this->input->post('membresia_id');
        $nombre = $this->input->post('nombre');
        $precio = $this->input->post('precio');
        $cant_anuncio = $this->input->post('cant_anuncio');
        $descuento = $this->input->post('descuento');
        $sorteo = $this->input->post('sorteo');
        $descripcion = $this->input->post('descripcion');
        $subastas = $this->input->post('subastas');
        $membresia_object = $this->membresia->get_by_id($membresia_id);



        if ($membresia_object) {

            $data_membresia = [
                'nombre' => $nombre,
                'precio' => $precio,
                'cant_anuncio' => $cant_anuncio,
                'membresia_id' => $membresia_id,
                'descuento' => $descuento,
                'sorteo' => $sorteo,
                'descripcion' => $descripcion,
                'qty_subastas' => $subastas

            ];
            $this->membresia->update($membresia_id, $data_membresia);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("membresia/index");
        } else {
            show_404();
        }
    }

    public function delete($membresia_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $membresia_object = $this->membresia->get_by_id($membresia_id);

        if ($membresia_object) {
            $this->membresia->delete($membresia_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("membresia/index");
        } else {
            show_404();
        }
    }
}
