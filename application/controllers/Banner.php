<?php

class Banner extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Banner_model', 'banner');
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

        $all_banners = $this->banner->get_all();
        $data['all_banners'] = $all_banners;
        $this->load_view_admin_g("banner/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $this->load_view_admin_g('banner/add');
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $url = $this->input->post('url');
        $titulo = $this->input->post('titulo');
        $subtitulo = $this->input->post('subtitulo');
        $menu = $this->input->post('menu');

        //establecer reglas de validacion
        $this->form_validation->set_rules('menu', translate('menu_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("banner/add_index");
        } else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];
            $w = 1300;
            $h = 500;

            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = save_image_from_post('archivo', './uploads/banner', time(), $w, $h);
                if ($result[0]) {
                    $data_banner = [
                        'is_active' => 1,
                        'foto' => $result[1],
                        'url' => $url,
                        'titulo' => $titulo,
                        'subtitulo' => $subtitulo,
                        'menu_id' => $menu,
                    ];
                    $this->banner->create($data_banner);
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

    function update_index($banner_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $banner_object = $this->banner->get_by_id($banner_id);

        if ($banner_object) {
            $data['banner_object'] = $banner_object;
            $this->load_view_admin_g('banner/update', $data);
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

        $url = $this->input->post('url');
        $titulo = $this->input->post('titulo');
        $subtitulo = $this->input->post('subtitulo');
        $menu = $this->input->post('menu');

        $banner_id = $this->input->post('banner_id');
        $this->form_validation->set_rules('menu', translate('menu_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("banner/update_index/" . $banner_id);
        } else { //en caso de que todo este bien
            $w = 1300;
            $h = 500;

            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension || $_FILES['archivo']['error'] == 4) {

                if ($_FILES['archivo']['error'] == 4) {
                    $data = [
                        'url' => $url,
                        'titulo' => $titulo,
                        'subtitulo' => $subtitulo,
                        'menu_id' => $menu

                    ];
                    $this->banner->update($banner_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("banner/index", "location", 301);
                } else {

                    $banner_object = $this->banner->get_by_id($banner_id);

                    if ($banner_object) {

                        $result = save_image_from_post('archivo', './uploads/banner', time(), $w, $h);
                        if ($result[0]) {
                            if (file_exists($banner_object->foto))
                                unlink($banner_object->foto);

                            $data_banner = [

                                'foto' => $result[1],
                                'url' => $url,
                                'titulo' => $titulo,
                                'subtitulo' => $subtitulo,
                                'menu_id' => $menu
                            ];
                            $this->banner->update($banner_id, $data_banner);
                            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                            redirect("banner/index", "location", 301);
                        } else {
                            $this->response->set_message($result[1], ResponseMessage::ERROR);
                            redirect("banner/update_index/" . $banner_id, "location", 301);
                        }
                    } else {
                        show_404();
                    }
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("banner/update_index/" . $banner_id, "location", 301);
            }
        }
    }

    public function delete($banner_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
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
