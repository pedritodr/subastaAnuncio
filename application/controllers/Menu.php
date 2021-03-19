<?php

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Menu_model', 'menu');
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
            redirect('login/index');
        }

        $all_menus = $this->menu->get_all();
        $data['all_menus'] = $all_menus;
        $this->load_view_admin_g("menu/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('menu/add');
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $url = $this->input->post('url');
        $orden = $this->input->post('orden');

        //establecer reglas de validacion
        $this->form_validation->set_rules('url', translate('url_lang'), 'required');
        $this->form_validation->set_rules('orden', translate('orden_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("banner/add_index");
        } else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];
            $w = 720;
            $h = 1080;

            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = save_image_from_post('archivo', './uploads/menu', time(), $w, $h);
                if ($result[0]) {
                    $data = ['is_active' => 1, 'photo' => $result[1], 'url_destino' => $url, 'orden' => $orden];
                    $this->banner->create($data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("banner/index", "location", 301);
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("banner/add_index", "location", 301);
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("banner/add_index", "location", 301);
            }
        }
    }

    function update_index($menu_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $menu_object = $this->menu->get_by_id($menu_id);

        if ($menu_object) {
            $data['menu_object'] = $menu_object;
            $this->load_view_admin_g('menu/update', $data);
        } else {
            show_404();
        }
    }

    public function update()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $frase = $this->input->post('frase');

        // $orden = $this->input->post('orden');
        //establecer reglas de validacion
        // $this->form_validation->set_rules('url', translate('url_lang'), 'required');

        $menu_id = $this->input->post('menu_id');

        $w = 1280;
        $h = 853;

        $name_file = $_FILES['archivo']['name'];
        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension || $_FILES['archivo']['error'] == 4) {

            if ($_FILES['archivo']['error'] == 4) {
                $data = ['frase' => $frase];
                $this->menu->update($menu_id, $data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("menu/index", "location", 301);
            } else {

                $menu_object = $this->menu->get_by_id($menu_id);

                if ($menu_object) {

                    $result = save_image_from_post('archivo', './uploads/menu', time(), $w, $h);
                    if ($result[0]) {
                        if (file_exists($menu_object->imagen))
                            unlink($menu_object->imagen);

                        $data = ['photo_main' => $result[1], 'frase' => $frase];
                        $this->menu->update($menu_id, $data);
                        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                        redirect("menu/index", "location", 301);
                    } else {
                        $this->response->set_message($result[1], ResponseMessage::ERROR);
                        redirect("menu/update_index/" . $menu_id, "location", 301);
                    }
                } else {
                    show_404();
                }
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("menu/update_index/" . $menu_id, "location", 301);
        }
    }

    public function delete($banner_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $banner_object = $this->banner->get_by_id($banner_id);

        if ($banner_object) {
            $this->banner->update($banner_id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("banner/index");
        } else {
            show_404();
        }
    }
}
