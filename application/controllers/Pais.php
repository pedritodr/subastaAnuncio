<?php

class Pais extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Pais_model', 'pais');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index() //pais
    {

        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login');
        }

        $all_pais = $this->pais->get_all();
        $data['all_pais'] = $all_pais;
        $this->load_view_admin_g("pais/index", $data);
    }



    public function add_index() //agregar pais al index
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $this->load_view_admin_g('pais/add');
    }


    public function add() //agregar pais
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $name_pais = $this->input->post('name_pais');

        //establecer reglas de validacion
        $this->form_validation->set_rules('name_pais', translate('nombre_lang'), 'required');


        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("pais/add_index", "location", 301);
        } else { //en caso de que todo este bien


                    $data = ['name_pais' => $name_pais];
                    $this->pais->create($data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("pais/index");
        }

        }



    function update_index($pais_id = 0) //modificar pais desde el index
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $pais_object = $this->pais->get_by_id($pais_id);

        if ($pais_object) {
            $data['pais_object'] = $pais_object;
            $this->load_view_admin_g('pais/update', $data);
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

        $name_pais = $this->input->post('name_pais');
        $pais_id = $this->input->post('pais_id');
        $pais_object = $this->pais->get_by_id($pais_id);

        //establecer reglas de validacion
        $this->form_validation->set_rules('name_pais', translate('nombre_lang'), 'required');
        //$this->form_validation->set_rules('price', translate('price_lang'), 'required|numeric');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("pais/update_index/" . $pais_id);
        } else { //en caso de que todo este bien



                    $data = ['name_pais' => $name_pais];
                    $this->pais->update_pais($pais_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("pais/index");


            }
        }


    public function delete($pais_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $pais_object = $this->pais->get_by_id($pais_id);

        if ($pais_object) { //eliminado foto

            $this->pais->delete_pais($pais_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("pais/index");
        } else {
            show_404();
        }
    }



function index_ciudad($pais_id = 0) //index de ciudad
{
    if (!in_array($this->session->userdata('role_id'), [1, 2])) {
        $this->log_out();
        redirect('login');
    }

    $all_ciudad = $this->pais->get_by_pais_id_object($pais_id);

    $data['all_ciudad'] = $all_ciudad;
    $data['pais_id'] = $pais_id;

    $this->load_view_admin_g('pais/index_ciudad', $data);
}



//crea el registro de las ciudades
public function add_ciudades()
{
    if (!in_array($this->session->userdata('role_id'), [1, 2])) {
        $this->log_out();
        redirect('login');
    }
//FK
    $name = $this->input->post('name_ciudad');
    $pais_id = $this->input->post('pais_id');

    //establecer reglas de validacion
    $this->form_validation->set_rules('name_ciudad', translate('fullname_lang'), 'required');

    if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
        $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
        redirect("pais/index_ciudad");
    }

    else { //en caso de que todo este bien
        $data_ciudad = [
           'name_ciudad' => $name,
           'pais_id' => $pais_id,


        ];
        $this->pais->create_cuidad($data_ciudad);
        $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
        redirect("pais/index_ciudad/" .$pais_id);
    }
}


function update_ciudad_index($ciudad_id= 0)
{
    if (!in_array($this->session->userdata('role_id'), [1, 2])) {
        $this->log_out();
        redirect('login');
    }

    $ciudad_object = $this->pais->get_by_ciudad_id_object($ciudad_id);

    if ($ciudad_object) {
        $data['ciudad_object'] = $ciudad_object;
        $this->load_view_admin_g('pais/ciudad_update', $data);
    } else {
        show_404();
    }
}


public function update_ciudades()
{
    if (!in_array($this->session->userdata('role_id'), [1, 2])) {
        $this->log_out();
        redirect('login');
    }

    $ciudad_id = $this->input->post('ciudad_id');

    $name_ciudad = $this->input->post('name_ciudad');


    $ciudad_object = $this->pais->get_by_ciudad_id_object($ciudad_id);



        if ($ciudad_object) {

                $data = ['name_ciudad' => $name_ciudad];
                $this->pais->update_ciudad($ciudad_id, $data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("pais/index_ciudad/" . $ciudad_object->pais_id);

        }

        else {
            show_404();
        }
}




    public function delete_ciudad($ciudad_id = 0){ //elimina las ciudades
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $ciudad_object = $this->pais->get_by_ciudad_id_object($ciudad_id);

        if ($ciudad_object) {
            $this->pais->delete_ciudad($ciudad_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("pais/index_ciudad/" . $ciudad_object->pais_id, "location", 301);
        } else {
            show_404();
        }
    }





}
