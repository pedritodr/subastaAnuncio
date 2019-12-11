<?php

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model', 'user');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index() //econtrando usuario
    {
        if(!in_array($this->session->userdata('role_id'),[1,2,3,4])){

            $this->log_out();
            redirect('login');
        }

        $all_users = $this->user->get_all();


        $data['all_users'] = $all_users;

        $this->load_view_admin_g("user/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2,3,4])) {
            $this->log_out();
            redirect('login');
        }
        $this->load->model('Role_model', 'role');
        $data['all_roles'] = $this->role->get_all();
        $this->load_view_admin_g('user/add', $data);
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1,2])) {
            $this->log_out();
            redirect('login');
        }

        $name = $this->input->post('fullname');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $phone = $this->input->post('phone');
        $repeat_password = $this->input->post('repeat_password');
        $role = $this->input->post('role');

        //establecer reglas de validacion
        $this->form_validation->set_rules('fullname', translate('fullname_lang'), 'required');
        $this->form_validation->set_rules('email', translate('email_lang'), 'required|is_unique[user.email]');
        $this->form_validation->set_rules('password', translate('password_lang'), 'required|matches[repeat_password]');
        $this->form_validation->set_rules('role', "Seleccione un rol", 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("user/add_index");
        } else { //en caso de que todo este bien
            $data_user = [
                'name' => $name,
                'email' => $email,
                'password' => md5($password),
                'phone' => $phone,
                'role_id' => $role,

            ];
            $this->user->create($data_user);
            $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
            redirect("user/index");
        }
    }

    function update_index($user_id = 0) //metodo get por url
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $user_object = $this->user->get_by_id($user_id);

        if ($user_object) {
            $data['user_object'] = $user_object;

            $this->load_view_admin_g('user/update', $data);
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
//los datos que se pueden actualizar
        $name = $this->input->post('fullname');
        $role = $this->input->post('role');
        $user_id = $this->input->post('user_id');

        //establecer reglas de validacion
        $this->form_validation->set_rules('fullname', translate('fullname_lang'), 'required');



        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("user/update_index/" . $user_id);
        } else { //en caso de que todo este bien
            $data_user = [
                'name' => $name,

            ];
            $this->user->update($user_id, $data_user);
            $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
            redirect("user/index");
        }
    }

    public function delete($user_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1,2])) {
            $this->log_out();
            redirect('login');
        }


        $user_object = $this->user->get_by_id($user_id);
        if ($user_object) {
            $this->user->delete($user_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("user/index");
        } else {
            show_404();
        }
    }


}
