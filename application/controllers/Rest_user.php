<?php
require(APPPATH . "libraries/REST_Controller.php");
require(APPPATH . "libraries/DatalabSecurity.php");
//require(APPPATH . "libraries/proveedores/AlignetWallet.php");
class Rest_user extends REST_Controller
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


    public function index_post()
    {

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $auth = $this->user->login($email, md5($password));

        if ($auth) {

            if ($auth->is_active == 1) {
                $token = md5($email . $password);
                $this->response(['ok' => $token]);
                $this->user->update($auth->user_id, ['security_token' => $token]);
                $this->response(['user_object' => $auth, 'status' => 200, 'security_token' => $token, 'user_id' => $auth->user_id, 'email' => $email, 'role_id' => $auth->role_id, 'name' => $auth->name, 'cedula' => $auth->cedula, 'phone' => $auth->phone, 'photo' => $auth->photo]);
            } else {

                $fecha = date("Y-m-d H:i:s");
                $fecha_vencimiento = strtotime('+5 minute', strtotime($fecha));
                $fecha_vencimiento = date("Y-m-d H:i:s", $fecha_vencimiento);

                $codigo_seguridad = '';
                $caracteres = '0123456789';

                for ($i = 0; $i < 4; $i++) {
                    $codigo_seguridad .= $caracteres[rand(0, strlen($caracteres) - 1)];
                }

                $this->user->update($auth->user_id, [
                    'codigo_seguridad' => $codigo_seguridad,
                    'fecha_vencimiento_codigo' => $fecha_vencimiento
                ]);

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

                $this->response(['status' => 402, 'email' => $email, 'user_object' => $auth]);
            }
        } else {
            $this->response(['status' => '404', 'msg' => 'Credenciales de acceso incorrectas']);
        }
    }

    public function delete_notification_post()
    {
        //------------------ Capa de seguridad ---------------------------------------------
        //------- Recogida de informacion --------------------------
        $encripted_text = json_decode($this->input->post('data'));

        if (!is_array($encripted_text)) { //valido que me halla llegado un arreglo con los bloques
            $this->response(['status' => '404', 'msg' => 'Petición rechazada']);
        }

        $obj_security = new DatalabSecurity();
        $datos_entrada = $obj_security->procesar_datos_entrada($encripted_text);
        //------- Fin de recogida de información ------------------



        //verificando integridad de la data que llegó
        if (!$datos_entrada) {
            $this->response(['status' => 404]);
        }

        //----------------- Fin de la capa de seguridad ------------------------------------------


        $user_id = $datos_entrada->user_id;
        $security_token = $datos_entrada->security_token;
        $not_id = $datos_entrada->not_id;

        $valid_auth = $this->user->is_valid_auth((string) $user_id, $security_token);

        if ($valid_auth) {
            $this->load->model("Notification_model", "not");
            $this->not->delete_not_single_user((string) $user_id, $not_id);
            $cantidad_not_pendientes = count($this->not->get_by_user((string) $user_id));
            $this->response(['status' => 200, 'cantidad_notificaciones' => $cantidad_not_pendientes]);
        } else {
            $this->response(['status' => 404]);
        }
    }

    public function delete_all_notifications_post()
    {
        //------------------ Capa de seguridad ---------------------------------------------
        //------- Recogida de informacion --------------------------
        $encripted_text = json_decode($this->input->post('data'));

        if (!is_array($encripted_text)) { //valido que me halla llegado un arreglo con los bloques
            $this->response(['status' => '404', 'msg' => 'Petición rechazada']);
        }

        $obj_security = new DatalabSecurity();
        $datos_entrada = $obj_security->procesar_datos_entrada($encripted_text);
        //------- Fin de recogida de información ------------------



        //verificando integridad de la data que llegó
        if (!$datos_entrada) {
            $this->response(['status' => 404]);
        }

        //----------------- Fin de la capa de seguridad ------------------------------------------


        $user_id = $datos_entrada->user_id;
        $security_token = $datos_entrada->security_token;


        $valid_auth = $this->user->is_valid_auth((string) $user_id, $security_token);

        if ($valid_auth) {
            $this->load->model("Notification_model", "not");
            $this->not->delete_by_user((string) $user_id);
            $this->response(['status' => 200]);
        } else {
            $this->response(['status' => 404]);
        }
    }

    public function get_notifications_post()
    {



        $user_id = base64_decode($this->input->post('user_id'));
        $security_token = $this->input->post('security_token');


        $valid_auth = $this->user->is_valid_auth((string) $user_id, $security_token);

        if ($valid_auth) {
            $this->load->model("Notification_model", "not");
            $lista_not = $this->not->get_by_user((string) $user_id);
            $this->response(['status' => 200, 'lista' => $lista_not]);
        } else {
            $this->response(['status' => 404]);
        }
    }


    public function verificar_identidad_post()
    {
        $imei = base64_decode($this->input->post('imei'));
        $user_object = $this->user->get_user_by_imei($imei);

        if ($user_object) {
            $this->response(['status' => 200, 'user' => $user_object]);
        } else {
            $this->response(['status' => 404, 'msg' => 'No se encuentra huella registrada con este teléfono']);
        }
    }

    public function update_huella_post()
    {
        $this->load->model("user_model", "user");
        // $security_token = base64_decode($this->input->post('security_token'));
        $user_id = base64_decode($this->input->post('user_id'));
        $token_huella = base64_decode($this->input->post('token_huella'));
        $imei = base64_decode($this->input->post('imei'));

        $headers = apache_request_headers();
        $security_token = base64_decode($headers['SecurityToken']);

        $valid_auth = $this->user->is_valid_auth((string) $user_id, $security_token);

        if ($valid_auth) {

            $this->user->update($valid_auth->email, ['has_huella' => 1, 'token_huella' => $token_huella, 'mobile_uuid' => $imei]);
            $this->response(['status' => 200, 'msg' => 'Huella actualizada correctamente']);
        } else {
            $this->response(['status' => 404]);
        }
    }

    public function probar_conexion_get()
    {
        $alignetObject = new AlignetWallet();
        /*  $response = $alignetObject->registerClient([
            'cedula'=>'111111111',
            'nombre'=>'Lulo',
            'telefono'=>'+593987670054',
            'email'=>'lulo@gmail.com',
            'phone_id'=>'596321444',
            'fecha_registro'=>date("Y-m-d H:i:s")
        ]);*/


        $response = $alignetObject->getToken('389', '819da708a9193b89');
        //echo $response; die();
        $tokenRequest = json_decode($response);
        $data_wallet = [
            'id_cliente' => '389',
            'cedula' => '0959108853',
            'segm1_card' => '485951',
            'segm2_card' => '0051',
            'segm1_fech' => '2',
            'segm2_fech' => '0',
            'codigo' => '6',
            'tipo' => 'VISA'
        ];

        $response = $alignetObject->saveCard($tokenRequest->access_token, $data_wallet);
        echo $response;
        die();
    }

    public function probar_conexion_comercio_get()
    {
        $codigo_comercio = 'c50d8615-912b-11e9-a242-0691584e30a800000000';
        $alignetObject = new AlignetWallet();
        $response = $alignetObject->getToken('389', '819da708a9193b89');
        //echo $response; die();
        $tokenRequest = json_decode($response);


        $response = $alignetObject->getDataComercio($tokenRequest->access_token, $codigo_comercio);
        echo $response;
        die();
    }

    public function register_post()
    {
        require(APPPATH . "libraries/validar_cedula.php");
        $name = $this->input->post('name');
        $surname = $this->input->post('surname');
        $tipo_documento = $this->input->post('tipo_documento');
        $cedula = $this->input->post('cedula');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $password = $this->input->post('password');
        $repeat_password = $this->input->post('repeat_password');
        //  $platform = $this->input->post('platform_id');
        //  $imei = $this->input->post('imei');
        //  $photo = $this->input->post('photo');
        if ($tipo_documento == 1) {
            // Crear nuevo objecto
            $validador = new validar_cedula();
            // validar CI
            if (!$validador->validarCedula($cedula)) {
                $this->response(['status' => 500, 'msg' => 'la cédula no cumple con el formato establecido en Ecuador'], 200);
            }
        }

        if ($password == $repeat_password) {

            $exist_email = $this->user->get_user_by_email($email);


            if (!$exist_email) {
                //Notificar a alignet el usuario

                $token = md5($email . $password);
                // $user_id = uniqid('client-');
                $user_id =   $this->user->create([
                    'name' => $name,
                    'surname' => $surname,
                    'tipo_documento' => $tipo_documento,
                    'email' => $email,
                    'password' => md5($password),
                    'role_id' => 2,
                    'phone' => $phone,
                    'is_active' => 0,
                    'security_token' => $token,
                    'cedula' => $cedula,

                ]);

                $fecha = date("Y-m-d H:i:s");
                $fecha_vencimiento = strtotime('+5 minute', strtotime($fecha));
                $fecha_vencimiento = date("Y-m-d H:i:s", $fecha_vencimiento);

                $codigo_seguridad = '';
                $caracteres = '0123456789';

                for ($i = 0; $i < 4; $i++) {
                    $codigo_seguridad .= $caracteres[rand(0, strlen($caracteres) - 1)];
                }

                $this->user->update($user_id, [
                    'codigo_seguridad' => $codigo_seguridad,
                    'fecha_vencimiento_codigo' => $fecha_vencimiento
                ]);


                $html = '<div style="width:100%;border:2px solid #034C75">';
                $html .= '<div style="background-color:#034C75;padding:10px;"><img style="width:48px;" src="" /><h1 style="color:#FFF;font-weight:bold;display:inline;font-size:36px;margin-left:10px;">Hola, </h1><h4 style="color:#fff;display:inline;font-size:28px;">' . $name . '</h4></div>';
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
                $this->email->subject('Registro de usuario APP');
                $this->email->message($html);
                $this->email->send();


                $user_object = $this->user->get_by_id($user_id);

                $this->response(['status' => 200, 'msg' => 'Registro exitoso', 'user_object' => $user_object, 'security_token' => $token, 'id' => $user_id], 200);
            } else {
                $this->response(['status' => 404, 'msg' => 'Ya existe un usuario con ese correo'], 200);
            }
        } else {
            $this->response(['status' => 404, 'msg' => 'Las contraseñan no coinciden'], 200);
        }
    }

    public function listar_get() //econtrando usuario
    {


        $all_users = $this->user->get_all();
        if ($all_users) {
            $this->response(['status' => 200, 'all_users' => $all_users]);
        } else {
            $this->response(['status' => 500]);
        }
    }

    public function validar_codigo_verificacion_post()
    {
        $email = $this->input->post('email');
        $codigo = $this->input->post('codigo');

        $user_object = $this->user->get_user_by_email($email);

        if ($user_object) {
            $now = date("Y-m-d H:i:s");
            if ($now > $user_object->fecha_vencimiento_codigo) {
                $this->response(['status' => 404, 'msg' => 'El código de verificación ya caducó. Por favor, mande a generar otró código.'], 200);
            } else {
                if ($codigo == $user_object->codigo_seguridad) {
                    $this->user->update($user_object->user_id, ['is_active' => 1, 'status' => 1]);
                    $this->response(['status' => 200, 'msg' => 'Validación correcta'], 200);
                } else {
                    $this->response(['status' => 404, 'msg' => 'El código de verificación no coincide.'], 200);
                }
            }
        } else {
            $this->response(['status' => 404, 'msg' => 'No se puede realizar la validación en este momento'], 200);
        }
    }

    public function generar_nuevo_codigo_post()
    {
        $email = $this->input->post('email');

        $user_object = $this->user->get_user_by_email($email);
        if ($user_object) {
            $fecha = date("Y-m-d H:i:s");
            $fecha_vencimiento = strtotime('+5 minute', strtotime($fecha));
            $fecha_vencimiento = date("Y-m-d H:i:s", $fecha_vencimiento);

            $codigo_seguridad = '';
            $caracteres = '0123456789';

            for ($i = 0; $i < 4; $i++) {
                $codigo_seguridad .= $caracteres[rand(0, strlen($caracteres) - 1)];
            }

            $this->user->update($user_object->user_id, [
                'codigo_seguridad' => $codigo_seguridad,
                'fecha_vencimiento_codigo' => $fecha_vencimiento
            ]);


            $html = '<div style="width:100%;border:2px solid #034C75">';
            $html .= '<div style="background-color:#034C75;padding:10px;"><img style="width:48px;" src="" /><h1 style="color:#FFF;font-weight:bold;display:inline;font-size:36px;margin-left:10px;">Hola, </h1><h4 style="color:#fff;display:inline;font-size:28px;">' . $user_object->name . '</h4></div>';
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
            $this->email->subject('Generación Código de Verificación');
            $this->email->message($html);
            $this->email->send();

            $this->response(['status' => 200, 'msg' => 'Código generado correctamente'], 200);
        } else {
            $this->response(['status' => 404, 'msg' => 'El email no pertenece a ningún usuario'], 200);
        }
    }

    public function validate_auth_post()
    {

        //------------------ Capa de seguridad ---------------------------------------------
        //------- Recogida de informacion --------------------------
        $encripted_text = json_decode($this->input->post('data'));

        if (!is_array($encripted_text)) { //valido que me halla llegado un arreglo con los bloques
            $formatted_data = json_encode(['status' => '404', 'msg' => 'Petición rechazada']);
            // $this->response(['data' => $formatted_data]);
            $datos_salida = $obj_security->procesar_datos_salida($formatted_data);
            //--------------- Fin datos de salida ----------------------------------------
            $this->response(['data' => $datos_salida]);
        }

        $obj_security = new DatalabSecurity();
        $datos_entrada = $obj_security->procesar_datos_entrada($encripted_text);
        //------- Fin de recogida de información ------------------



        //verificando integridad de la data que llegó
        if (!$datos_entrada) {
            //--------------- Preparando datos de salida ---------------------------------
            $formatted_data = json_encode(['status' => 404]);
            // $this->response(['data' => $formatted_data]);
            $datos_salida = $obj_security->procesar_datos_salida($formatted_data);
            //--------------- Fin datos de salida ----------------------------------------
            $this->response(['data' => $datos_salida]);
        }

        //----------------- Fin de la capa de seguridad ------------------------------------------


        $user_id = $datos_entrada->user_id;

        $headers = apache_request_headers();
        $security_token = base64_decode($headers['SecurityToken']);

        $valid_auth = $this->user->is_valid_auth((string) $user_id, $security_token);

        if ($valid_auth) {
            //--------------- Preparando datos de salida ---------------------------------
            $formatted_data = json_encode(['status' => 200]);
            // $this->response(['data' => $formatted_data]);
            $datos_salida = $obj_security->procesar_datos_salida($formatted_data);
            //--------------- Fin datos de salida ----------------------------------------
            $this->response(['data' => $datos_salida]);
        } else {
            //--------------- Preparando datos de salida ---------------------------------
            $formatted_data = json_encode(['status' => 404]);
            // $this->response(['data' => $formatted_data]);
            $datos_salida = $obj_security->procesar_datos_salida($formatted_data);
            //--------------- Fin datos de salida ----------------------------------------
            $this->response(['data' => $datos_salida]);
        }
    }

    public function add_to_favorite_post()
    {
        $headers = apache_request_headers();
        $security_token = base64_decode($headers['SecurityToken']);
        $user_id = base64_decode($this->input->post('user_id_encoded'));
        $valid_auth = $this->user->is_valid_auth((string) $user_id, $security_token);

        if ($valid_auth) {
            $titulo = base64_decode($this->input->post('titulo'));

            $nservicio = base64_decode($this->input->post('nservicio'));
            $codigo_servicio = base64_decode($this->input->post('codigo_servicio'));


            $exist_favorito = $this->user->exist_favorite($nservicio, $codigo_servicio, (string) $user_id);

            if (!$exist_favorito) {
                $this->user->add_to_favorite([
                    'tipo_servicio' => $nservicio,
                    'codigo_servicio' => $codigo_servicio,
                    'user_id' => (string) $user_id,
                    'nombre' => $titulo
                ]);

                $this->response(['status' => 200]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 501]);
        }
    }

    public function billetera_amount_post()
    {
        $user_id = $this->input->post('user_id');

        $this->load->library('encrypt');
        $user_id_decoded  = $this->encrypt->decode($user_id);

        $user_object = $this->user->get_by_id((string) $user_id_decoded);

        if ($user_object) {
            $this->response(['status' => 200, 'msg' => $user_object->billetera]);
        } else {
            $this->response(['status' => 404]);
        }
    }


    public function list_favoritos_post()
    {
        $user_id = $this->input->post('user_id');

        $this->load->library('encrypt');
        $user_id_decoded = $this->encrypt->decode($user_id);
    }

    public function list_fav_user_cat_post()
    {
        $nservicio_id = $this->input->post('nservicio_id');
        $user_id_encoded = $this->input->post('user_id');

        $this->load->library('encrypt');
        $user_id_decoded = $this->encrypt->decode($user_id_encoded);

        $list_favoritos = $this->user->get_mis_favoritos_by_cat($nservicio_id, (string) $user_id_decoded);
        $this->response(['status' => 200, 'lista_favoritos' => $list_favoritos]);
    }

    public function list_fav_user_multiple_cat_post()
    {

        $encripted_text = json_decode($this->input->post('data'));

        if (!is_array($encripted_text)) { //valido que me halla llegado un arreglo con los bloques
            $formatted_data = json_encode(['status' => '404', 'msg' => 'Petición rechazada']);
            // $this->response(['data' => $formatted_data]);
            $datos_salida = $obj_security->procesar_datos_salida($formatted_data);
            //--------------- Fin datos de salida ----------------------------------------
            $this->response(['data' => $datos_salida]);
        }

        $obj_security = new DatalabSecurity();
        $datos_entrada = $obj_security->procesar_datos_entrada($encripted_text);
        //verificando integridad de la data que llegó
        if (!$datos_entrada) {
            //--------------- Preparando datos de salida ---------------------------------
            $formatted_data = json_encode(['status' => '404', 'msg' => 'Petición rechazada']);
            $datos_salida = $obj_security->procesar_datos_salida($formatted_data);
            //--------------- Fin datos de salida ----------------------------------------
            $this->response(['data' => $datos_salida]);
        }

        //------- Fin de recogida de información ------------------


        $security_token = $datos_entrada->security_token;

        $user_id = $datos_entrada->user_id;
        $valid_auth = $this->user->is_valid_auth((string) $user_id, $security_token);

        if ($valid_auth) {
            $nservicio_id = $datos_entrada->nservicio_id;

            $lista_servicios = explode("~", $nservicio_id);
            $this->load->library('encrypt');


            $list_favoritos = $this->user->get_mis_favoritos_multiple_cat($lista_servicios, (string) $user_id);

            $this->response(['status' => 200, 'lista_favoritos' => $list_favoritos]);
        } else {
            $this->response(['status' => 501]);
        }
    }

    public function load_user_data_post()
    {


        $security_token = $this->input->post('security_token');
        $user_id = $this->input->post('user_id');

        $valid_auth = $this->user->is_valid_auth((string) $user_id, $security_token);

        if ($valid_auth) {

            $user_object = $this->user->get_by_id((string) $user_id);

            if ($user_object) {
                $cedula = (isset($user_object->cedula)) ? $user_object->cedula : "";
                $phone = (isset($user_object->phone)) ? $user_object->phone : "";
                $this->response(['user_object' => $user_object, 'status' => 200, 'name' => $user_object->name, 'cedula' => $cedula, 'phone' => $phone]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 404]);
        }
    }

    public function update_datos_perfil_post()
    {
        $name = $this->input->post('name');
        $cedula = $this->input->post('cedula');
        $phone = $this->input->post('phone');
        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $photo = $this->input->post('photo');
        $photo = "data:image/jpeg;base64," . $photo;


        $valid_auth = $this->user->is_valid_auth($user_id, $security_token);

        if ($valid_auth) {

            $user_object = $this->user->get_by_id($user_id);

            if ($user_object) {
                $this->user->update($user_id, [
                    'name' => $name,
                    'phone' => $phone,
                    'cedula' => $cedula,
                    'photo' => $photo
                ]);

                $user_object = $this->user->get_by_id($user_id);
                $this->response(['status' => 200, 'msg' => 'Datos de usuario editados correctamente', 'user_object' => $user_object]);
            } else {

                $this->response(['status' => 404, 'msg' => 'No existe el usuario que está intentando editar']);
            }
        } else {

            $this->response(['status' => 404]);
        }
    }

    public function change_password_post()
    {

        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');

        $valid_auth = $this->user->is_valid_auth($user_id, $security_token);

        if ($valid_auth) {
            $user_object = $this->user->get_by_id($user_id);
            if ($user_object) {
                if ($user_object->password == md5($old_password)) {
                    $new_token = md5($user_object->email . $new_password);
                    $this->user->update($user_object->user_id, [
                        'password' => md5($new_password),
                        'security_token' => $new_token
                    ]);
                    $this->response(['status' => 200, 'msg' => 'La contraseña ha sido cambiada correctamente', 'token' => $new_token, 'user_object' => $user_object]);
                } else {
                    $this->response(['status' => 500, 'msg' => 'La contraseña anterior no coincide']);
                }
            } else {
                $this->response(['status' => 404, 'msg' => 'No existe el usuario']);
            }
        } else {

            $this->response(['status' => 404]);
        }
    }

    public function load_operaciones_tienda_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $tienda_id = $this->input->post('tienda_id');

        $valid_auth = $this->user->is_valid_auth((string) $user_id, $security_token);

        if ($valid_auth) {

            $offset = $this->input->post('offset');

            $this->load->model('Transaction_model', 'trans');
            $limit = 10;
            $total_transacciones = $this->trans->total_operaciones_tienda($tienda_id);
            $show_next_page = 1;
            if (($offset + $limit) >= $total_transacciones) {
                $show_next_page = 0;
            }
            $lista_operaciones = $this->trans->get_operaciones_by_tienda($tienda_id, $limit, $offset);
            $offset += $limit;

            $lista_result = [];
            $this->load->model("Tienda_model", "tienda");
            foreach ($lista_operaciones as $item) {
                $item = (object) $item;
                $tienda_object = $this->tienda->get_by_id((int) $item->tienda_id);
                if ($tienda_object) {
                    $item->nombre_tienda = $tienda_object->nombre_tienda;
                } else {
                    $item->nombre_tienda = "No definido";
                }
                $lista_result[] = $item;
            }

            $this->response([
                'status' => 200,
                'msg' => 'Operaciones cargadas ok',
                'offset' => $offset,
                'total_transacciones' => $total_transacciones,
                'lista_operaciones' => $lista_result,
                'show_next_page' => $show_next_page
            ]);
        } else {
            $this->response([
                'status' => 501
            ]);
        }
    }

    public function load_operaciones_post()
    {



        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');

        $valid_auth = $this->user->is_valid_auth((string) $user_id, $security_token);

        if ($valid_auth) {

            $offset = $this->input->post('offset');

            $this->load->model('Transaction_model', 'trans');
            $limit = 10;
            $total_transacciones = $this->trans->total_operaciones_usuarios($user_id);
            $show_next_page = 1;
            if (($offset + $limit) >= $total_transacciones) {
                $show_next_page = 0;
            }
            $lista_operaciones = $this->trans->get_operaciones_by_user($user_id, $limit, $offset);
            $offset += $limit;

            $lista_result = [];
            $this->load->model("Tienda_model", "tienda");
            foreach ($lista_operaciones as $item) {
                $item = (object) $item;
                $tienda_object = $this->tienda->get_by_id((int) $item->tienda_id);
                if ($tienda_object) {
                    $item->nombre_tienda = $tienda_object->nombre_tienda;
                } else {
                    $item->nombre_tienda = "No definido";
                }
                $lista_result[] = $item;
            }

            $this->response([
                'status' => 200,
                'msg' => 'Operaciones cargadas ok',
                'offset' => $offset,
                'total_transacciones' => $total_transacciones,
                'lista_operaciones' => $lista_result,
                'show_next_page' => $show_next_page
            ]);
        } else {
            $this->response([
                'status' => 501
            ]);
        }
    }


    public function generar_new_password_post()
    {


        $email = $this->input->post('email');

        $user_object = $this->user->get_user_by_email($email);

        if ($user_object) {

            $new_password = time();
            $this->user->update($user_object->user_id, ['password' => md5($new_password), 'security_token' => md5($email . $new_password)]);

            $html = '<div style="width:100%;border:2px solid #034C75">';
            $html .= '<div style="background-color:#034C75;padding:10px;"><img style="width:48px;" src="https://s3.amazonaws.com/pagahoy.com/assets/1x1oscurotransparente.png" /><h1 style="color:#FFF;font-weight:bold;display:inline;font-size:36px;margin-left:10px;">Hola, </h1><h4 style="color:#fff;display:inline;font-size:28px;">' . $user_object->name . '</h4></div>';
            $html .= '<div style="margin-top:10px;">El equipo de <b>Paga Hoy</b> te informa que se ha generado una nueva contraseña, la cual se muestra a continuación: </div>';
            $html .= '<div style="text-align:center;font-weight:bold;font-size:24px;">' . $new_password . '</div>';
            $html .= '<div style="">Muchas gracias por utilizar nuestro servicio.</div>';
            $html .= '<div style="font-weight:bold;">Equipo Paga Hoy</div>';
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

            $this->email->from('pedro@datalabcenter.com', 'Info subastanucios.com');
            $this->email->to($email);
            $this->email->subject('Recuperación de contraseña');
            $this->email->message($html);
            $this->email->send();

            $this->response(['status' => 200, 'msg' => 'Password generado y enviado a su correo.']);
        } else {

            $this->response(['status' => 404, 'msg' => 'No se encuentra el email especificado']);
        }
    }


    //autenticacion basado en reconocimiento de rostros
    public function register_foto_auth_get()
    {
        $url_photo = "http://www.fondox.net/wallpapers/rostro-limpio-y-sin-arrugas-486.jpg";
        //$url_photo = "https://images-blogger-opensocial.googleusercontent.com/gadgets/proxy?url=http%3A%2F%2Fdefinicionde.hugex.net%2Fwp-content%2Fuploads%2F2015%2F07%2Fe1001e86903d5fccba2a7e83a0547bd4.jpg&container=blogger&gadget=a&rewriteMime=image%2F*";
        $face_recognition_object = new Face_recognition($url_photo);
        $result = $face_recognition_object->detectar_rostro("https://eastasia.api.cognitive.microsoft.com/face/v1.0/detect?returnFaceId=true&returnFaceLandmarks=true");

        $resultado_face_detect = json_decode($result);
        if (!is_array($resultado_face_detect)) {
            $this->response(['status' => 400, 'msg' => $resultado_face_detect->message]);
        } else {

            if (count($resultado_face_detect) == 1) {

                $face_id = $resultado_face_detect[0]->faceId;
                $face_rectangle = $resultado_face_detect[0]->faceRectangle;

                //almacenar la foto en la infraestructura de microsoft
                $lista_grupos = $face_recognition_object->listar_grupo_personas('https://eastasia.api.cognitive.microsoft.com/face/v1.0/largepersongroups');
                $result_lista_grupos = json_decode($lista_grupos);
                $grupo_id = null;
                if (count($result_lista_grupos) == 0) { //si no existen grupos creados, creo el grupo que almacenará las fotos
                    $response_create_group_str = $face_recognition_object->create_large_group("https://eastasia.api.cognitive.microsoft.com/face/v1.0/largepersongroups/1", "grupo1", "Grupo 1 Paga Hoy");

                    $response_grupo_object = json_decode($response_create_group_str);
                    $this->user->create_grupo(['grupo_id' => $response_grupo_object->largePersonGroupId, 'cant_personas' => 0]);
                    $grupo_id = $response_grupo_object->largePersonGroupId;
                } else {

                    //saber la cantidad de personas que tiene ese grupo, si son menores que 1 Millon, agrego la cara al grupo, en caso contrario creo otro grupo
                    $grupo_activo = $this->user->get_grupo_activo();
                    if ($grupo_activo->cant_personas < 1000000) {
                        //pongo la foto en este grupo
                        $grupo_id = $grupo_activo->grupo_id;
                    } else {
                        $response_create_group_str1 = $face_recognition_object->create_large_group("https://eastasia.api.cognitive.microsoft.com/face/v1.0/largepersongroups/" . ($grupo_activo->grupos_reconocimiento_rostro_id + 1), "grupo" . ($grupo_activo->grupos_reconocimiento_rostro_id + 1), "Grupo " . ($grupo_activo->grupos_reconocimiento_rostro_id + 1) . " Paga Hoy");

                        $response_grupo_object1 = json_decode($response_create_group_str1);
                        $this->user->create_grupo(['grupo_id' => $response_grupo_object1->largePersonGroupId, 'cant_personas' => 0]);
                        $grupo_id = $response_grupo_object1->largePersonGroupId;
                    }
                }


                //me quedé aqui

            } elseif (count($resultado_face_detect) == 0) {
                $this->response(['status' => 400, 'msg' => 'No se encuentran rostros en la foto.']);
            } else {
                $this->response(['status' => 400, 'msg' => 'No se pudo agregar la foto porque en la misma se encuentran más de un rostro.']);
            }
        }
    }


    function exist_client_by_mail_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');

        $valid_auth = $this->user->is_valid_auth($user_id, $security_token);

        if ($valid_auth) {
            $email_client_pagahoy = $this->input->post('email');
            $exist = $this->user->get_client_by_email($email_client_pagahoy);
            if ($exist) {
                $this->response(['status' => 200, 'name' => $exist->name, 'phone' => $exist->phone, 'cedula' => $exist->cedula]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 501]);
        }
    }

    function mis_solicitudes_pendientes_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');

        $valid_auth = $this->user->is_valid_auth((string) $user_id, $security_token);

        if ($valid_auth) {
            $this->load->model('venta_model', 'venta');
            $mis_solicitudes_pendientes = $this->venta->get_solicitudes_pendientes((string) $user_id);
            $this->load->model('tienda_model', 'tienda');
            $result = [];
            foreach ($mis_solicitudes_pendientes as $item) {
                $item = (object) $item;
                $tienda_object = $this->tienda->get_by_id($item->tienda_id);
                $item->tienda_object = $tienda_object;
                $result[] = $item;
            }
            $this->response(['status' => 200, 'solicitudes' => $result]);
        } else {
            $this->response(['status' => 404]);
        }
    }

    function delete_solicitud_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $solicitud_id = $this->input->post('solicitud_id');

        $valid_auth = $this->user->is_valid_auth((string) $user_id, $security_token);

        if ($valid_auth) {
            $this->load->model('venta_model', 'venta');
            $this->venta->delete_solicitud($solicitud_id);

            $solicitud_object = $this->venta->get_solicitud_pago_by_id($solicitud_id);

            $this->load->model("Tienda_model", "tienda");
            $tienda_object = $this->tienda->get_by_id($solicitud_object->tienda_id);

            $user_object = $this->user->get_by_id($solicitud_object->user_id_pagador);

            $html = '<div style="width:100%;border:2px solid #034C75">';
            $html .= '<div style="background-color:#034C75;padding:10px;"><img style="width:48px;" src="https://s3.amazonaws.com/pagahoy.com/assets/1x1oscurotransparente.png" /><h1 style="color:#FFF;font-weight:bold;display:inline;font-size:36px;margin-left:10px;">Hola, </h1><h4 style="color:#fff;display:inline;font-size:28px;">' . $tienda_object->nombre_tienda . '</h4></div>';
            $html .= '<div style="margin-top:10px;">El equipo de <b>Paga Hoy</b> te informa que el usuario <b>' . $user_object->name . '</b>, ha rechazado un pago que se le ha solicitado desde tu establecimiento. </div>';

            $html .= '<div style="">Para verificar el detalle de esta operación, acceda a su oficina virtual dentro de Paga Hoy.</div><br />';
            $html .= '<div>Muchas gracias por utilizar nuestro servicio</div><br />';
            $html .= '<div style="font-weight:bold;">Equipo Paga Hoy</div>';
            $html .= '</div>';


            $this->load->library('email');

            $config = array();
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'ssl://smtp.zoho.com';
            $config['smtp_user'] = 'info@pagahoy.com';
            $config['smtp_pass'] = '5tgbvfr43edcxsw21qaz';
            $config['smtp_port'] = 465;
            $config['mailtype'] = 'html';
            $this->email->initialize($config);

            $this->email->set_newline("\r\n");

            $this->email->from('info@pagahoy.com', 'Info Paga Hoy');
            $this->email->to($tienda_object->email);
            $this->email->subject('Rechazo en solicitud de pago');
            $this->email->message($html);
            $this->email->send();

            $this->response(['status' => 200]);
        } else {
            $this->response(['status' => 404]);
        }
    }
}
