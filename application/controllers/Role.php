<?php

class Role  extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Role_model', 'role'); 
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index() //econtrando rol
    {
        if(!in_array($this->session->userdata('role_id'),[1,2,3,4])){

            $this->log_out();
            redirect('login/index');
        }

        $all_role = $this->role->get_all();


        $data['all_role'] = $all_role;

        $this->load_view_admin_g("role/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2,3,4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Role_model', 'role');
        $data['all_roles'] = $this->role->get_all();
        $this->load_view_admin_g('role/add', $data);
    }

    public function add() 
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2,3,4])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('fullname');


        //establecer reglas de validacion
        $this->form_validation->set_rules('fullname', translate('role_lang'), 'required');
        

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("role/add_index");
        } else { //en caso de que todo este bien
            $data_role = [
                'name' => $name,
                
            ];
            $this->role->create($data_role);
            $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
            redirect("role/index");
        }
    }

    function update_index($role_id = 0) //metodo get por url 
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2,3,4])) {
            $this->log_out();
            redirect('login/index');
        }

        $role_object = $this->role->get_by_id($role_id);

        if ($role_object) {
            $data['role_object'] = $role_object;

            $this->load_view_admin_g('role/update', $data);
        } else {
            show_404();
        }
    }

    public function update()
    {
        if (!in_array($this->session->userdata('role_id'), [1,2,3,4])) {
            $this->log_out();
            redirect('login/index');
        }
//los datos que se pueden actualizar 
        $name = $this->input->post('fullname');
        $role_id = $this->input->post('role_id');
       
        //establecer reglas de validacion
        $this->form_validation->set_rules('fullname', translate('role_lang'), 'required');



        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("role/update_index/" . $role_id);
        } else { //en caso de que todo este bien
            $data_role = [
                'name' => $name,

            ];
            $this->role->update($role_id, $data_role);
            $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
            redirect("role/index");
        }
    }

    public function delete($role_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2,3,4])) {
            $this->log_out();
            redirect('login/index');
        }

        $role_object = $this->role->get_by_id($role_id);

        if ($role_object) {
            $this->role->delete($role_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("role/index");
        } else {
            show_404();
        }
    }

    public function profile_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1,2,3,4])) {
            $this->log_out();
            redirect('login/index');
        }

        $role_id = $this->session->userdata('role_id');

        $user_object = $this->user->get_by_id($role_id);



        if ($user_object) {

            $data['user_object'] = $user_object;
            $this->load_view_admin_g('user/profile', $data);
        } else {
            show_404();
        }
    }

    public function execute_edit_profile()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('fullname');
        $role = $this->input->post('role');
        $user_id = $this->input->post('user_id');

        //establecer reglas de validacion
        $this->form_validation->set_rules('fullname', translate('fullname_lang'), 'required');



        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("usuario/update_index/" . $user_id);
        } else { //en caso de que todo este bien
            $data_user = [
                'name' => $name,
            ];
            $this->user->update($user_id, $data_user);
            $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
            redirect("dashboard/index");
        }
    }

    public function credenciales_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2,3,4])) {
            $this->log_out();
            redirect('login/index');
        }
        $user_id = $this->session->userdata('user_id');

        $user_object = $this->user->get_by_id($user_id);



        if ($user_object) {
            $data['user_object'] = $user_object;
            $this->load_view_admin_g('usuario/credenciales', $data);
        } else {
            show_404();
        }
    }
    public function execute_edit_credencial()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $email = $this->input->post("email");
        $password = $this->input->post("password");
        $user_id = $this->input->post("user_id");
        $validacion = $this->input->post("validacion");

        $user_object =  $this->user->get_by_id($user_id);
        if ($user_object->email == $email) {
            $this->form_validation->set_rules('email', 'Email', 'required');
        } else {
            $this->form_validation->set_rules('email', translate('email_lang'), 'required|is_unique[user.email]');
        }


        $this->form_validation->set_rules('password', translate("password_lang"), 'required');



        if ($this->form_validation->run() == FALSE) {
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("user/credenciales_index/");
        } else {

            if ($validacion == 0) {
                $data_user = [
                    "email" => $email

                ];

                $this->user->update($user_id, $data_user);
                $this->response->set_message('Los datos se guardaron correctamente', ResponseMessage::SUCCESS);
                redirect("dashboard/index");
            } else {
                $data_user = [
                    "email" => $email,
                    "password" => md5($password)
                ];

                $this->user->update($user_id, $data_user);
                $this->response->set_message('Los datos se guardaron correctamente', ResponseMessage::SUCCESS);
                redirect("dashboard/index");
            }
        }
    }
}
