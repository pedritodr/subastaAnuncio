<?php

class Color_product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Color_product_model', 'color_product');
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

        $all_colores = $this->color_product->get_all();
        $data['all_colores'] = $all_colores;
        $this->load_view_admin_g("color_product/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('color_product/add');
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');

        $this->form_validation->set_rules('name', "Nombre", 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("color_product/add_index");
        } else {
            $data = ['nombre' => $name];
            $this->color_product->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("color_product/index", "location", 301);
        }
    }

    function update_index($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $color_object = $this->color_product->get_by_id($id);

        if ($color_object) {
            $data['color_object'] = $color_object;
            $this->load_view_admin_g('color_product/update', $data);
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

        $name = $this->input->post('name');
        $color_id = $this->input->post('color_id');

        $this->form_validation->set_rules('name', "Nombre", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("color_product/update_index/" . $color_id);
        } else {
            $color_object = $this->color_product->get_by_id($color_id);

            if ($color_object) {
                $data = ['nombre' => $name];
                $this->color_product->update($color_id, $data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("color_product/index", "location", 301);
            } else {
                show_404();
            }
        }
    }

    public function delete($id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $color_object = $this->color_product->get_by_id($id);

        if ($color_object) {
            $this->color_product->delete($id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("color_product/index");
        } else {
            show_404();
        }
    }
}
