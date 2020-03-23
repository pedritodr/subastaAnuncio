<?php

class Premio extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Premio_model', 'premio');
        $this->load->model('Membresia_model', 'membresia');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_premios = $this->premio->get_all();
        $data['all_premios'] = $all_premios;
        $this->load_view_admin_g("premio/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('premio/add');
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load->model('Pais_model', 'pais');
        $premio = $this->input->post('premio');
        $cantidad = $this->input->post('cantidad');
        $sorteo = $this->input->post('sorteo');
        $date = date("Y-m-d");
        $users = $this->membresia->get_all_membresias_user_date($date);
        foreach ($users as $user) {
            $user->ciudad = $this->pais->get_by_ciudad_id_object($user->ciudad_id);
        }
        $ganadores = [];
        if ($cantidad == 0) {
            $this->response->set_message(translate("qty_wins_lang"), ResponseMessage::ERROR);
            redirect("premio/add_index", "location", 301);
        }
        //establecer reglas de validacion
        $this->form_validation->set_rules('premio', translate('qty_wins_lang'), 'required');
        $this->form_validation->set_rules('cantidad', translate('description_lang'), 'required');
        $this->form_validation->set_rules('sorteo', translate('sorteo'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("premio/add_index");
        } else { //en caso de que todo este bien
            if ($sorteo == 1) {
                if ($cantidad == count($users)) {
                } elseif ($cantidad > count($users)) {
                    $this->response->set_message(translate("error_cantidad_lang"), ResponseMessage::ERROR);
                    redirect("premio/add_index", "location", 301);
                } elseif ($cantidad < count($users)) {
                    $wins = array_rand($users, $cantidad);
                    if (is_array($wins)) {
                        for ($i = 0; $i < count($wins); $i++) {
                            array_push($ganadores, $users[$i]);
                        }
                    } else {
                        array_push($ganadores, $users[$wins]);
                    }
                }
                $data = [
                    'premio' => $premio,
                    'cantidad_ganadores' => $cantidad,
                    'tipo' => $sorteo,
                    'fecha_create' => $date,
                    'ganadores' => json_encode($ganadores)
                ];
                $this->premio->create($data);
            } else {
            }








            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("premio/index", "location", 301);
        }
    }

    function update_index($premio_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $premio_object = $this->premio->get_by_id($premio_id);

        if ($premio_object) {

            $data['premio_object'] = $premio_object;
            $this->load_view_admin_g('premio/update', $data);
        } else {
            show_404();
        }
    }

    public function update()
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $nombre = $this->input->post('nombre');
        $desc = $this->input->post('desc');

        $icono = $this->input->post('icono');
        $resumen = $this->input->post('resumen');

        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('desc', translate('description_lang'), 'required');


        $premio_id = $this->input->post('premio_id');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("premio/update_index/" . $premio_id);
        } else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension || $_FILES['archivo']['error'] == 4) {

                if ($_FILES['archivo']['error'] == 4) {
                    $data = ['is_active' => 1, 'descripcion' => $desc, 'nombre' => $nombre, 'resumen' => $resumen, 'icono' => $icono];
                    $this->premio->update($premio_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("premio/index", "location", 301);
                } else {

                    $premio_object = $this->premio->get_by_id($premio_id);

                    if ($premio_object) {

                        $result = save_image_from_post('archivo', './uploads/premio', time(), 360, 220);
                        if ($result[0]) {
                            if (file_exists($premio_object->imagen))
                                unlink($premio_object->imagen);

                            $data = ['is_active' => 1, 'descripcion' => $desc, 'nombre' => $nombre, 'imagen' => $result[1], 'resumen' => $resumen, 'icono' => $icono];
                            $this->premio->update($premio_id, $data);

                            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                            redirect("premio/index", "location", 301);
                        } else {
                            $this->response->set_message($result[1], ResponseMessage::ERROR);
                            redirect("premio/add_index", "location", 301);
                        }
                    } else {
                        show_404();
                    }
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("premio/update_index/" . $premio_id, "location", 301);
            }
        }
    }

    public function delete($premio_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login/index');
        }

        $premio_object = $this->premio->get_by_id($premio_id);

        if ($premio_object) {
            $this->premio->update($premio_id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("premio/index");
        } else {
            show_404();
        }
    }
}
