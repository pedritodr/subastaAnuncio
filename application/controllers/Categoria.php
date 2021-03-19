<?php

class Categoria extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Categoria_model', 'categoria');

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

        $all_categorias = $this->categoria->get_all();
        $data['all_categorias'] = $all_categorias;
        $this->load_view_admin_g("categoria/index", $data);
    }

    public function subcategoria($id)
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $all_categorias = $this->categoria->get_all_subcat_from_idcat($id);

        $data['all_categorias'] = $all_categorias;
        $data['idcategoria'] = $id;
        $this->load_view_admin_g("categoria/subcategoria", $data);
    }



    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $this->load_view_admin_g('categoria/add');
    }

    public function add_index2()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $this->load_view_admin_g('categoria/add2');
    }


    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $name_espa = $this->input->post('name_espa');
        //establecer reglas de validacion
        $this->form_validation->set_rules('name_espa', translate('nombre_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("categoria/add_index", "location", 301);
        } else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = save_image_from_post('archivo', './uploads/categoria', time(), 60, 60);
                if ($result[0]) {
                    $data = ['name_espa' => $name_espa, 'photo' => $result[1], 'is_active' => 1];
                    $this->categoria->create($data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("categoria/index");
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("categoria/add_index", "location", 301);
                }
            } else {
                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("categoria/add_index", "location", 301);
            }
        }
    }

    public function add2()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }
        $name_espa = $this->input->post('name_espa');
        $idcategoria = $this->input->post('idcategoria');
        $data = ['nombre' => $name_espa, 'categoria_id' => $idcategoria];

        $this->categoria->create2($data);
        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
        redirect("categoria/subcategoria/" . $idcategoria);
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
                        $result = save_image_from_post('archivo', './uploads/categoria', time(), 60, 60);
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
                redirect("categoria/update_index/" . $categoria_id);
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

    public function update_subcategoria()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }
        $name_espa = $this->input->post('name_espa');
        $sub_categoria = $this->input->post('sub_categoria');
        $idcategoria = $this->input->post('idcategoria');
        $data = ['nombre' => $name_espa];
        $this->categoria->update_subcategoia($sub_categoria, $data);
        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
        redirect("categoria/subcategoria/" . $idcategoria);
    }

    public function delete2($categoria_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }
        $obj_sub = $this->categoria->get_subcat_by_id($categoria_id);
        if ($obj_sub) {
            $this->categoria->delete2($categoria_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("categoria/subcategoria/" . $obj_sub->categoria_id);
        } else {
            show_404();
        }
    }
}
