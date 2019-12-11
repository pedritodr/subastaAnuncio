<?php

class Anuncio extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Anuncio_model', 'anuncio');
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

        $all_anuncios = $this->anuncio->get_all();
        $data['all_anuncios'] = $all_anuncios;
        $this->load_view_admin_g("anuncio/index", $data);
    }



    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $this->load_view_admin_g('anuncio/add');
    }


    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }



        $titulo = $this->input->post('titulo');
        $descripcion = $this->input->post('descripcion');
        $precio = $this->input->post('precio');
        $photo = $this->input->post('photo');
        $whatsapp = $this->input->post('whatsapp');
        $cate_anuncio = $this->input->post('nombre');




        //establecer reglas de validacion
        $this->form_validation->set_rules('titulo', translate('nombre_lang'), 'required');


        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("titulo/add_index", "location", 301);
        } else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];

            $separado = explode('.', $name_file);


            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = save_image_from_post('archivo', './uploads/categoria', time(), 768, 768);
                if ($result[0]) {
                    $data = ['titulo' => $titulo,
                    'descripcion' => $descripcion,
                    'precio' => $precio,
                    'photo' => $result[1],
                    'whatsapp' => $whatsapp,
                    'cate_anuncio_id' => $cate_anuncio,
                    'is_active' => 1];
                    $this->anuncio->create($data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("anuncio/index");
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("anuncio/add_index", "location", 301);
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("anuncio/add_index", "location", 301);
            }
        }
    }


    function update_index($categoria_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $categoria_object = $this->categoria->get_by_id($categoria_id);

        if ($categoria_object) {
            $data['categoria_object'] = $categoria_object;
            $this->load_view_admin_g('categoria/update', $data);
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

        $name_espa = $this->input->post('name_espa');
        $categoria_id = $this->input->post('categoria_id');
        $categoria_object = $this->categoria->get_by_id($categoria_id);

        //establecer reglas de validacion
        $this->form_validation->set_rules('name_espa', translate('nombre_lang'), 'required');
        //$this->form_validation->set_rules('price', translate('price_lang'), 'required|numeric');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("categoria/update_index/" . $categoria_id);
        } else { //en caso de que todo este bien

            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension || $_FILES['archivo']['error'] == 4) {

                if ($_FILES['archivo']['error'] == 4) {
                    $data = ['name_espa' => $name_espa];
                    $this->categoria->update($categoria_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("categoria/index");
                } else {

                    if ($categoria_object) { //modificando la foto

                        $result = save_image_from_post('archivo', './uploads/categoria', time(), 768, 768);
                        if ($result[0]) {
                            if (file_exists($categoria_object->photo))
                                unlink($categoria_object->photo);

                            $data = ['name_espa' => $name_espa, 'photo' => $result[1]];
                            $this->categoria->update($categoria_id, $data);
                            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                            redirect("categoria/index");
                        } else {
                            $this->response->set_message($result[1], ResponseMessage::ERROR);
                            redirect("categoria/update_index/" . $categoria_id);
                        }
                    } else {
                        show_404();
                    }
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("categoria/update_index/" . $coleccion_id);
            }
        }
    }



    public function delete($categoria_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $categoria_object = $this->categoria->get_by_id($categoria_id);

        if ($categoria_object) { //eliminado foto
            unlink($categoria_object->photo);



            $this->categoria->delete($categoria_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("categoria/index");
        } else {
            show_404();
        }
    }


}