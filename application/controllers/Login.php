<?php

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model', 'user');
        $this->load->model('Membresia_model', 'membresia');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }



    public function index()
    {

        $this->load->view("login");
    }

    public function auth()
    {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $anuncio = $this->input->post('valida_ads');
        $subasta_id = $this->input->post('subasta_id_login');
        //$subasta = json_decode($_POST['subasta_login_frm']);
        $subasta = json_decode($this->input->post('subasta_login_frm'));

        if ($subasta != NULL || $subasta != "") {

            $this->session->set_userdata('subasta', $subasta);
        }
        if ($subasta_id != "") {
            $this->session->set_userdata('subasta_id', $subasta_id);
        }

        $user = $this->user->get_all(['email' => $email, 'password' => $password, 'status' => 1], TRUE);

        if ($user) {

            $session_data = object_to_array($user);

            if ($user->role_id == 2) {
                $membresia = $this->membresia->get_by_user_id($user->user_id);
                $membresia = object_to_array($membresia);
                $this->session->set_userdata($membresia);
            }
            $this->session->set_userdata($session_data);

            if ($user->role_id == 1) {
                redirect("dashboard/index");
            } else if ($user->role_id == 2) {
                $this->session->set_userdata('login', "ok");
                if ($anuncio == 1) {
                    redirect("crear-anuncio");
                } else {

                    $this->session->set_userdata('validando', 1);
                    redirect("portada");
                    //  redirect("portada");
                }
            } else {
                redirect(site_url());
            }
        } else {
            $user_obj = $this->user->get_user_by_email($email);
            if ($user_obj) {
                if ($user_obj->status == 0 && $user_obj->is_active == 0) {
                    $fecha = date("Y-m-d H:i:s");
                    $fecha_vencimiento = strtotime('+5 minute', strtotime($fecha));
                    $fecha_vencimiento = date("Y-m-d H:i:s", $fecha_vencimiento);

                    $codigo_seguridad = '';
                    $caracteres = '0123456789';

                    for ($i = 0; $i < 4; $i++) {
                        $codigo_seguridad .= $caracteres[rand(0, strlen($caracteres) - 1)];
                    }

                    $this->user->update($user_obj->user_id, ['codigo_seguridad' => $codigo_seguridad, 'fecha_vencimiento_codigo' => $fecha_vencimiento]);

                    $html = '<div style="width:100%;border:2px solid #034C75">';
                    $html .= '<div style="background-color:#034C75;padding:10px;"><img style="width:48px;" src="" /><h1 style="color:#FFF;font-weight:bold;display:inline;font-size:36px;margin-left:10px;">Hola, </h1><h4 style="color:#fff;display:inline;font-size:28px;">' . $auth->name . '</h4></div>';
                    $html .= '<div style="margin-top:10px;">El equipo de <b>APP</b> quiere agradecerte por formar parte de nuestra comunidad.<br/> Solo te queda un paso para completar tu registro, para validar que tu correo es real, ingresa en tu aplicación el código que te aparece a continuación: </div>';
                    $html .= '<div style="text-align:center;font-weight:bold;font-size:24px;">' . $codigo_seguridad . '</div>';
                    $html .= '<div style="">No nos queda más que desearte que disfrutes la experiencia utilizar nuestra plataforma.</div>';
                    $html .= '<div style="font-weight:bold;">Equipo APP</div>';
                    $html .= '</div>';


                    $this->load->library('email');

                    $config['protocol'] = 'smtp';
                    $config['smtp_host'] = 'smtp.zoho.com';
                    $config['smtp_user'] = 'pedro@datalabcenter.com';
                    $config['smtp_pass'] = "01420109811";
                    $config['smtp_port'] = '465';
                    //$config['smtp_timeout'] = '5';
                    //$config['smtp_keepalive'] = TRUE;
                    $config['smtp_crypto'] = 'ssl';
                    $config['charset'] = 'utf-8';
                    $config['newline'] = "\r\n";
                    $config['mailtype'] = 'html';
                    $config['wordwrap'] = TRUE;
                    $this->email->initialize($config);

                    $this->email->set_newline("\r\n");

                    $this->email->from('pedro@datalabcenter.com', 'Info APP');
                    $this->email->to($email);
                    $this->email->subject('Validación de usuario APP');
                    $this->email->message($html);
                    $this->email->send();
                    //   $session_data = object_to_array($user);
                    //  $this->session->set_userdata($session_data);
                    $this->response->set_message('El código de verificación ha sido generado correctamente', ResponseMessage::SUCCESS);
                    // $this->session->set_userdata('validando', 1);
                    redirect("activacion");
                } else {
                    $this->response->set_message(translate('autenticacion_lang'), ResponseMessage::ERROR);
                    redirect("login");
                }
            } else {
                $this->response->set_message(translate('autenticacion_lang'), ResponseMessage::ERROR);
                redirect("login");
            }
        }
    }
    public function auth_ajax()
    {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));

        $user = $this->user->get_all(['email' => $email, 'password' => $password, 'status' => 1], TRUE);

        if ($user) {

            $session_data = object_to_array($user);

            $membresia = $this->membresia->get_by_user_id($user->user_id);
            $membresia = object_to_array($membresia);
            $this->session->set_userdata($membresia);

            $this->session->set_userdata($session_data);
            $data['session_data'] = $session_data;
            $data['membresia'] = $membresia;
            $data['status'] = 200;
            echo json_encode($data);
            exit();
        } else {
            $data['status'] = 500;
            echo json_encode($data);
            exit();
        }
    }
    public function facebook_auth()
    {
    }

    public function logout()
    {
        parent::log_out();
        redirect(site_url());
    }

    public function recover_password_index()
    {
        $this->load->view("recover_password");
    }

    public function recover_password()
    {
        $email = $this->input->post("email");
        $this->load->model("User_model", "user");
        $user_object = $this->user->get_user_by_email($email);
        if ($user_object) {
            $new_password = time();
            $this->user->update($user_object->user_id, ["password" => md5($new_password)]);
            $this->load->model("Correo_model", "correo");
            $asunto = "Cambio de clave";
            $motivo = 'Cambio de contraseña Subasta anuncios';
            $mensaje = "<p><img style='width:209px;heigth:44px' src='https://subastanuncios.com/assets/logo_subasta.png'></p>";
            $mensaje .= "Hola <br>Has solicitado el restablecimiento de tu contraseña para acceder al perfil: (" . $email . ").<br>";
            $mensaje .= "Con el objetivo de proteger tus datos en todo momento, hemos generado una nueva contraseña para que puedas acceder de manera adecuada a la plataforma.<br>";
            $mensaje .= "Nueva Contraseña:" . $new_password . "<br>";
            $mensaje .= "Si usted presentara algún problema para la ejecución del procedimiento indicado, debe comunicarse con nuestro equipo de soporte a través del mail info@suabastanuncios.com.<br>";
            $mensaje .= "Ha sido un placer ayudarte. Continúa utilizando nuestras herramientas.<br>";
            $mensaje .= "Gracias por preferirnos<br>";
            $mensaje .= "Saludos,<br>";
            $mensaje .= "El equipo de SUBASTANUNCIOS";
            $this->correo->sent($email, $mensaje, $asunto, $motivo);
            $this->response->set_message(translate('cambiada_lang'), ResponseMessage::SUCCESS);
            redirect("login");
        } else {
            $this->response->set_message(translate('correo_no_lang'), ResponseMessage::ERROR);
            redirect("login");
        }
    }
}
