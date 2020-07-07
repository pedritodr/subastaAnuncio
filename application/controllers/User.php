<?php

class User extends CI_Controller
{
    private const WIDTH = 100;
    private const HEIGHT = 100;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model', 'user');
        $this->load->model('Pais_model', 'pais');
        $this->load->model('Payment_model', 'payment');
        $this->load->model('Membresia_model', 'membresia');
        $this->data['img_width'] = $this::WIDTH;
        $this->data['img_height'] = $this::HEIGHT;
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index() //econtrando usuario
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3, 4])) {

            $this->log_out();
            redirect('login');
        }

        $all_users = $this->user->get_all_2(['status' => 1]);


        $data['all_users'] = $all_users;

        $this->load_view_admin_g("user/index", $data);
    }

    public function cliente() //econtrando usuario
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3, 4])) {

            $this->log_out();
            redirect('login');
        }

        $all_users = $this->user->get_all(['role_id' => 2]);

        $data['all_users'] = $all_users;

        $this->load_view_admin_g("user/cliente", $data);
    }

    public function detalles($id)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $usuarios = $this->user->get_by_id($id);
        $city = $this->pais->get_ciudad_by_id($usuarios->ciudad_id);
        if ($city) {
            foreach ($city as $result) {
                $ciudad = $result->name_ciudad;
            }
        } else {
            $ciudad = NULL;
        }

        $all_payment = $this->payment->get_by_payment_user_id_all($usuarios->user_id);
        $membresia = $this->membresia->get_membresia_by_user_id2($usuarios->user_id);
        // $tipomembresia = $this->membresia->get_by_id($membresia->membresia_id);
        $allmembresia = $this->membresia->get_all();
        $data["allmembresia"] = $allmembresia;
        $data['usuarios'] = $usuarios;
        $data['ciudad'] = $ciudad;
        $data['allpay'] = $all_payment;
        $data['membresia'] = $membresia;
        //$data['tipomembresia'] = $tipomembresia;

        $this->load_view_admin_g('user/detalles', $data);
    }
    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 3, 4])) {
            $this->log_out();
            redirect('login');
        }
        $this->load->model('Role_model', 'role');
        $data['all_roles'] = $this->role->get_all();
        $this->load_view_admin_g('user/add', $data);
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $name = $this->input->post('fullname');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $phone = $this->input->post('phone');
        $repeat_password = $this->input->post('repeat_password');
        $role = $this->input->post('role');
        if ($password != $repeat_password) {
            $this->response->set_message("Los campos contraseña y repetir contraseña no coinciden.", ResponseMessage::ERROR);
            redirect("user/add_index");
        }

        //establecer reglas de validacion
        $this->form_validation->set_rules('fullname', translate('fullname_lang'), 'required');
        $this->form_validation->set_rules('email', translate('email_lang'), 'required|is_unique[user.email]');
        //  $this->form_validation->set_rules('password', translate('password_lang'), 'required|matches[repeat_password]');
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
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }


        $user_object = $this->user->get_by_id($user_id);
        if ($user_object) {
            $this->user->update($user_id, ['status' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("user/index");
        } else {
            show_404();
        }
    }


    public function profile_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $user_id = $this->session->userdata('user_id');

        $user_object = $this->user->get_by_id($user_id);
        $city = $this->pais->get_by_ciudad_id_object($user_object->ciudad_id);
        $cityall = $this->pais->get_all_ciudad();


        if ($user_object) {

            $data['user_object'] = $user_object;
            $data['city'] = $city;
            $data['cityall'] = $cityall;
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
        $name_file = $_FILES['archivo']['name'];
        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
        $allow_extension = in_array($ext, $allow_extension_array);
        $name = $this->input->post('fullname');
        $surname = $this->input->post('surname');
        $phone = $this->input->post('phone');
        $cedula = $this->input->post('cedula');
        $ciudad = $this->input->post('ciudad');
        $direccion = $this->input->post('direccion');
        $user_id = $this->input->post('user_id');

        if ($allow_extension) {
            $result = save_image_from_post('archivo', './uploads/Cliente', time(), $this::WIDTH, $this::HEIGHT);

            if ($result[0]) {
                $data_user = [
                    'name' => $name,
                    'surname' => $surname,
                    'phone' => $phone,
                    'cedula' => $cedula,
                    'ciudad_id' => $ciudad,
                    'direccion' => $direccion,
                    'photo' => $result[1]

                ];
                $this->user->update($user_id, $data_user);
            }
        } else {
            $data_user = [
                'name' => $name,
                'surname' => $surname,
                'phone' => $phone,
                'cedula' => $cedula,
                'ciudad_id' => $ciudad,
                'direccion' => $direccion


            ];
            $this->user->update($user_id, $data_user);
        }

        $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
        redirect("user/profile_index");
    }

    public function credenciales_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $user_id = $this->session->userdata('user_id');

        $user_object = $this->user->get_by_id($user_id);



        if ($user_object) {
            $data['user_object'] = $user_object;
            $this->load_view_admin_g('user/credenciales', $data);
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
        $password = $this->input->post("newpassword");
        $oldpassword = $this->input->post("oldpassword");
        $user_id = $this->input->post("user_id");
        $validacion = $this->input->post("validacion");
        $user_object =  $this->user->get_by_id($user_id);
        if ($user_object->password == md5($oldpassword)) {
            $data_user = [
                "password" => md5($password)
            ];
            $this->user->update($user_id, $data_user);
            $this->response->set_message("Actualizado", ResponseMessage::SUCCESS);
            redirect("user/credenciales_index/");
        } else {
            $this->response->set_message("Compruebe sus contraseñas", ResponseMessage::ERROR);
            redirect("user/credenciales_index/");
        }
    }
}
