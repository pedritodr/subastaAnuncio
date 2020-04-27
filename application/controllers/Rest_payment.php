<?php
require(APPPATH . "libraries/REST_Controller.php");
require(APPPATH . "libraries/DatalabSecurity.php");
//require(APPPATH . "libraries/proveedores/AlignetWallet.php");
class Rest_payment extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('User_model', 'user');
        $this->load->model('payment_model', 'payment');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }


    public function credenciales_post()
    {
        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        //carga de credenciales.
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        if ($auth) {
            $payment = $this->payment->get_by_credenciales();
            if ($payment) {
                //Genera codigo aleatorio para el trankey
                $length = 8;
                $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $nonce = '';
                for ($i = 0; $i < $length; $i++) {
                    $nonce .= $characters[rand(0, $charactersLength - 1)];
                }
                //carga las credenciales de login,secretkey, para luego crear el trankey y las variables necesarias para realizar la peticion.
                $login = $payment->login;
                $secretkey = $payment->secret_key;
                $seed = Date("Y-m-d\TH:i:sP");
                $tranKey = base64_encode(sha1($nonce . $seed . $secretkey, true));
                $nonce = base64_encode($nonce);
                $this->response(['status' => 200, 'login' => $login, 'seed' => $seed, 'trankey', $tranKey, 'nonce' => $nonce]);
            } else {
                $this->response(['status' => 404, 'msg' => 'Error al cargar credenciales'], 200);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function checkout_post()
    {
        require(APPPATH . "libraries/Curl.php");
        $this->load->model('payment_model', 'payment');
        $this->load->model('User_model', 'user');
        //carga de credenciales.
        $payment = $this->payment->get_by_credenciales();
        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        //carga de credenciales.
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        if ($auth) {
            $detalle = $this->input->post('detalle');
            $id =  $this->input->post('id');
            $tipo = (int) $this->input->post('tipo');
            $valor = (float) $this->input->post('monto');
            if ($tipo == 0) {
                $this->load->model('Membresia_model', 'membresia');
                $obj = $this->membresia->get_by_id($id);
                $monto = (float) $obj->precio;
                $base = $monto / 1.12;
                $iva = $monto - $base;
            } elseif ($tipo == 1) {
                $this->load->model('Subasta_model', 'subasta');
                $obj = $this->subasta->get_by_id($id);

                $monto = $valor;
                $base = $monto / 1.12;
                $iva = $monto - $base;
            } elseif ($tipo == 2) {

                $monto = $valor;
                $base = $monto / 1.12;
                $iva = $monto - $base;
            } elseif ($tipo == 3) {

                $monto = $valor;
                $base = $monto / 1.12;
                $iva = $monto - $base;
            }
            $unico = $this->payment->create_unico(['status' => 1]);

            $reference = 'RF-' . time() . "-" . $unico;
            $ip = empty($_SERVER["REMOTE_ADDR"]) ? "Desconocida" : $_SERVER["REMOTE_ADDR"];
            $obj_user = $this->user->get_by_id($user_id);
            $fecha = date("Y-m-d H:i:s");
            $fecha_vencimiento = strtotime('+20 minute', strtotime($fecha));
            $fecha_vencimiento = date("Y-m-d H:i:s", $fecha_vencimiento);
            if ($obj_user->tipo_documento == 1) {
                $tipo_documento = "CI";
            } else {
                $tipo_documento = "PPN";
            }
            //Genera codigo aleatorio para el trankey
            $length = 8;
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $nonce = '';
            for ($i = 0; $i < $length; $i++) {
                $nonce .= $characters[rand(0, $charactersLength - 1)];
            }
            //carga las credenciales de login,secretkey, para luego crear el trankey y las variables necesarias para realizar la peticion.
            $login = $payment->login;
            $secretkey = $payment->secret_key;
            $seed = Date("Y-m-d\TH:i:sP");
            $tranKey = base64_encode(sha1($nonce . $seed . $secretkey, true));
            $nonce = base64_encode($nonce);
            $request = [

                "auth" => [
                    "login" => $login,
                    "seed" => "$seed",
                    "nonce" => $nonce,
                    "tranKey" => $tranKey
                ],
                "buyer" => [
                    "name" => $obj_user->name,
                    "surname" => "$obj_user->surname",
                    "email" => $obj_user->email,
                    "documentType" => $tipo_documento,
                    "document" => $obj_user->cedula,
                    "mobile" => $obj_user->phone,
                ],
                "payment" => [
                    "reference" => $reference,
                    "description" => $detalle,
                    "amount" => [
                        "taxes" => [

                            [
                                "kind" => "valueAddedTax",
                                "amount" => $iva,
                                "base" => $base
                            ]
                        ],

                        "currency" => "USD",
                        "total" => $monto
                    ],


                ],
                "expiration" => $fecha_vencimiento,
                "ipAddress" => $ip,
                "userAgent" => "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.86 Safari/537.36",
                "returnUrl" => site_url('transaccion'),
                "cancelUrl" => site_url('transaccion_cancelada'),
                "skipResult" => false,
                "noBuyerFill" => false,
                "captureAddress" => false,
                "paymentMethod" => null
            ];

            $json = json_encode($request);
            $url = $payment->end_ponit . 'api/session';
            $curl = new Curl();
            $response = $curl->full_consulta_post($url, $json);
            $payment_id =  $this->payment->create(['user_id' => $user_id, 'detalle' => $detalle, 'status' => 0, 'id' => $id, 'tipo' => $tipo, 'monto' => $monto, 'request_id' => "a", 'reference' => $reference, 'date' => $fecha, 'estado_reverso' => 0]);
            $this->payment->update($payment_id, ['request_id' => $response->requestId]);
            $payment_obj = $this->payment->get_by_id($payment_id);
            $this->response(['status' => 200, 'result' => $response, 'payment' => $payment_obj]);
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function update_request_post()
    {
        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $request_id = $this->input->post('request_id');
        $reference = $this->input->post('reference');
        $status = $this->input->post('status');
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        if ($auth) {
            $obj = $this->payment->get_by_reference_id($reference);
            if ($obj) {
                $this->payment->update($obj->payment_id, ['status' => $status, 'request_id' => $request_id]);
                $obj = $this->payment->get_by_id($obj->payment_id);
                $this->response(['status' => 200, 'payment' => $obj]);
            } else {
                $this->response(['status' => 500]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function payments_user_post()
    {
        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        if ($auth) {
            $obj = $this->payment->get_by_payment_user_id($user_id);
            if (count($obj) > 0) {
                $this->response(['status' => 200, 'obj' => $obj]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
}
