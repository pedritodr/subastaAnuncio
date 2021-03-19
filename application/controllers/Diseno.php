<?php

class Diseno extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Diseno_model', 'diseno');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }


//crea la vista

    function foto_coleccion($diseno_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_fotos = $this->diseno->get_by_foto_diseno_id($diseno_id);


        $data['all_fotos'] = $all_fotos;
        $data['diseno_id'] = $diseno_id;

        $this->load_view_admin_g('diseno/foto_producto', $data);
    }

//crea el registro
    public function add_foto()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
//FK
        $diseno_id = $this->input->post('diseno_id');
        //en caso de que todo este bien
        $name_file = $_FILES['archivo']['name'];

        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension) {
            $result = save_image_from_post('archivo', './uploads/coleccion', time(), 768, 768);
            if ($result[0]) {
                $data = ['photo' => $result[1], 'diseno_id' => $diseno_id];
                $this->diseno->create_foto_diseno($data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("diseno/foto_coleccion/" . $diseno_id);
            } else {
                $this->response->set_message($result[1], ResponseMessage::ERROR);
                redirect("diseno/foto_coleccion/" . $diseno_id, "location", 301);
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("diseno/foto_coleccion/" . $diseno_id, "location", 301);
        }
    }
    

      
    

//llama a la vista que actuliza una foto en especifico

    function update_foto_coleccion_index($foto_diseno_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $foto_diseno_object = $this->diseno->get_by_foto_diseno_id_object($foto_diseno_id);

        if ($foto_diseno_object) {
            $data['foto_diseno_object'] = $foto_diseno_object;
            $this->load_view_admin_g('diseno/foto_producto_update', $data);
        } else {
            show_404();
        }
    }


//actualiza la imagen de la galeria segun la imagen seleccionada a actualzar
    public function update_foto_coleccion()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $foto_diseno_id = $this->input->post('foto_diseno_id');
        $foto_diseno_object = $this->diseno->get_by_foto_diseno_id_object($foto_diseno_id);

        $name_file = $_FILES['archivo']['name'];
        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension || $_FILES['archivo']['error'] == 4) {

            if ($foto_diseno_object) {

                $result = save_image_from_post('archivo', './uploads/diseno', time(), 768, 768);
                if ($result[0]) {
                    if (file_exists($foto_diseno_object->photo))
                        unlink($foto_diseno_object->photo);

                    $data = ['photo' => $result[1]];
                    $this->diseno->update_foto_diseno($foto_diseno_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("diseno/foto_coleccion/" . $foto_diseno_object->diseno_id);
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("diseno/update_foto_coleccion_index/" . $foto_diseno_id);
                }
            } else {
                show_404();
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("diseno/update_foto_coleccion_index/" . $foto_diseno_id);
        }
    }

   //elimina fisicamente una imagen seleccionada en especifico de la galeria

    public function delete_foto($foto_diseno_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $foto_diseno_object = $this->diseno->get_by_foto_diseno_id_object($foto_diseno_id);

        if ($foto_diseno_object) {
            unlink($foto_diseno_object->photo);
            $this->diseno->delete_foto_diseno($foto_diseno_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("diseno/foto_coleccion/" . $foto_diseno_object->diseno_id, "location", 301);
        } else {
            show_404();
        }
    }
}
