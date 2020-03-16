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
    public function index_usuarios()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $all_users = $this->membresia->get_all_membresias_users();

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
                'descripcion' => $descripcion
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

        $membresia_object = $this->membresia->get_by_id($membresia_id);



        if ($membresia_object) {

            $data_membresia = [
                'nombre' => $nombre,
                'precio' => $precio,
                'cant_anuncio' => $cant_anuncio,
                'membresia_id' => $membresia_id,
                'descuento' => $descuento,
                'sorteo' => $sorteo,
                'descripcion' => $descripcion

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
