<?php
require(APPPATH . "libraries/PPM.php");
class Payment_admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Payment_model', 'payment');
        $this->load->model('User_model', 'user');
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
        $all_payment = $this->payment->get_all();
        foreach ($all_payment as $item) {
            $item->user = $this->user->get_by_id($item->user_id);
        }
        $data['all_payment'] = $all_payment;
        $this->load_view_admin_g("payment/index", $data);
    }
    public function reverso()
    {
        require(APPPATH . "libraries/Curl.php");
        //$request_id = $this->input->post('request_id');

        $payment = $this->payment->get_by_credenciales();

        $length = 8;
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $nonce = '';
        for ($i = 0; $i < $length; $i++) {
            $nonce .= $characters[rand(0, $charactersLength - 1)];
        }

        $login = $payment->login;
        $secretkey = $payment->secret_key;
        $seed = Date("Y-m-d\TH:i:sP");
        $tranKey = base64_encode(sha1($nonce . $seed . $secretkey, true));
        $nonce = base64_encode($nonce);


        $request_id = "155782";
        $object = $this->payment->get_by_request_id($request_id);

        $date = date("Y-m-d", strtotime($object->date));
        $date = date("Y-m-d H:i:00", strtotime($date . "23:59"));
        $fecha = date("Y-m-d H:i:00", time());
        if (strtotime($date) < strtotime($fecha)) {
            $json = '{
                "auth": {
                    "login": "' . $login . '",
                    "seed": "' . $seed . '",
                    "nonce": "' . $nonce . '",
                    "tranKey": "' . $tranKey . '"
                },
            }';

            $url = $payment->end_ponit . 'api/session/' . $request_id;
            $url = 'https://test.placetopay.ec/redirection/api/session/155782';

            $curl = new Curl();
            $response = $curl->full_consulta_post($url, $json);
            $internalReference = $response->payment[0]->internalReference;

            var_dump($internalReference);
            die();


            $ppm = new PPM();
            $response = $ppm->reverse($request_id);
            if ($response) {
                if ($response->payment) {
                    $this->payment->update($object->payment_id, ['status' => 4]);
                    $this->load->model('Membresia_model', 'membresia');
                    $this->load->model('Anuncio_model', 'anuncio');
                    $this->load->model('Subasta_model', 'subasta');
                    if ($object->tipo == 0) {
                        $this->membresia->update_membresia_user_payment($object->payment_id, ['estado' => 0]);
                    } elseif ($object->tipo == 1) {
                        $this->subasta->update_subasta_user($object->payment_id, ['is_active' => 0]);
                    } elseif ($object->tipo == 2) {
                        $this->anuncio->update_payment($object->payment_id, ['destacado' => 0]);
                    } elseif ($object->tipo == 3) {
                        $this->subasta->update_subasta_user($object->payment_id, ['is_active' => 0]);
                        $subasta = $this->subasta->get_intevalo_by_id($object->id);
                        $count = count($subasta);
                        if ((int) $subasta[$count - 1]->cantidad == 0) {
                            $this->subasta->update($object->id, ['is_open' => 1]);
                        }

                        $cantidad = (int) $subasta[$count - 1]->cantidad + 1;
                        $this->subasta->update_intervalo($subasta[$count - 1]->intervalo_subasta_id, ['cantidad' => $cantidad]);
                    }

                    echo json_encode(['status' => 500, 'mensaje' => $response->status()->message(), 'estado' => $response->status()->status()]);
                } else {
                    echo json_encode(['status' => 404]);
                }
            }
        } else {
            echo json_encode(['status' => 200]);
        }
        exit();
    }
    public function reverso_manual()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }
        $request_id = $this->input->post('request_id');
        //   $request_id = "155866";
        $object = $this->payment->get_by_request_id($request_id);


        if ($object) {
            $this->payment->update($object->payment_id, ['status' => 4]);
            $this->load->model('Membresia_model', 'membresia');
            $this->load->model('Anuncio_model', 'anuncio');
            $this->load->model('Subasta_model', 'subasta');
            if ($object->tipo == 0) {
                $this->membresia->update_membresia_user_payment($object->payment_id, ['estado' => 0]);
            } elseif ($object->tipo == 1) {
                $this->subasta->update_subasta_user($object->payment_id, ['is_active' => 0]);
            } elseif ($object->tipo == 2) {
                $this->anuncio->update_payment($object->payment_id, ['destacado' => 0]);
            } elseif ($object->tipo == 3) {
                $this->subasta->update_subasta_user($object->payment_id, ['is_active' => 0]);
                $subasta = $this->subasta->get_intevalo_by_id($object->id);
                $count = count($subasta);
                if ((int) $subasta[$count - 1]->cantidad == 0) {
                    $this->subasta->update($object->id, ['is_open' => 1]);
                }

                $cantidad = (int) $subasta[$count - 1]->cantidad + 1;
                $this->subasta->update_intervalo($subasta[$count - 1]->intervalo_subasta_id, ['cantidad' => $cantidad]);
            }

            echo json_encode(['status' => 500]);
        } else {
            echo json_encode(['status' => 404]);
        }


        exit();
    }
    public function prueba() //funciona consumiendo la api
    {
        require(APPPATH . "libraries/Curl.php");
        $payment = $this->payment->get_by_credenciales();
        $length = 8;
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $nonce = '';
        for ($i = 0; $i < $length; $i++) {
            $nonce .= $characters[rand(0, $charactersLength - 1)];
        }

        $login = $payment->login;
        $secretkey = $payment->secret_key;
        $seed = Date("Y-m-d\TH:i:sP");
        $tranKey = base64_encode(sha1($nonce . $seed . $secretkey, true));
        $nonce = base64_encode($nonce);
        $request_id = "155782";
        /*   $json = '{
            "auth": {
                "login": "' . $login . '",
                "seed": "' . $seed . '",
                "nonce": "' . $nonce . '",
                "tranKey": "' . $tranKey . '"
            },
            "internalReference": "80898"

        }'; */
        // API URL to send data
        $json = '{
            "auth": {
                "login": "' . $login . '",
                "seed": "' . $seed . '",
                "nonce": "' . $nonce . '",
                "tranKey": "' . $tranKey . '"
            }
        }';
        $url = 'https://test.placetopay.ec/redirection/api/session/155782';

        $curl = new Curl();
        $response = $curl->full_consulta_post($url, $json);
        var_dump($response->payment[0]->internalReference);
        die();
    }
    public function reverso_nuevo() //funciona consumiendo la api
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }
        require(APPPATH . "libraries/Curl.php");
        //carga de credenciales.
        $payment = $this->payment->get_by_credenciales();
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
        $request_id = $this->input->post('request_id');

        //  $request_id = "156577";
        $object = $this->payment->get_by_request_id($request_id);
        $date = date("Y-m-d", strtotime($object->date));
        $date = date("Y-m-d H:i:00", strtotime($date . "23:59"));
        $fecha = date("Y-m-d H:i:00", time());

        if (strtotime($date) > strtotime($fecha)) {

            $json = '{
            "auth": {
                "login": "' . $login . '",
                "seed": "' . $seed . '",
                "nonce": "' . $nonce . '",
                "tranKey": "' . $tranKey . '"
            }
        }';
            $url = $payment->end_ponit . 'api/session/' . $request_id;

            $curl = new Curl();
            $response = $curl->full_consulta_post($url, $json);

            if ($response->status->status == "APPROVED") {
                $internalReference = $response->payment[0]->internalReference;

                $json = '{
                "auth": {
                    "login": "' . $login . '",
                    "seed": "' . $seed . '",
                    "nonce": "' . $nonce . '",
                    "tranKey": "' . $tranKey . '"
                },
                "internalReference": "' . $internalReference . '" }';
                $url = $payment->end_ponit . 'api/reverse';
                $curl = new Curl();
                $response = $curl->full_consulta_post($url, $json);

                if ($response) {
                    if ($response->status->status == "APPROVED") {
                        //estado_reverso==1 reverso automatico
                        $this->payment->update($object->payment_id, ['status' => 4, 'estado_reverso' => 1]);
                        $this->load->model('Membresia_model', 'membresia');
                        $this->load->model('Anuncio_model', 'anuncio');
                        $this->load->model('Subasta_model', 'subasta');

                        if ($object->tipo == 0) {
                            $this->membresia->update_membresia_user_payment($object->payment_id, ['estado' => 0]);
                        } elseif ($object->tipo == 1) {
                            $this->subasta->update_subasta_user($object->payment_id, ['is_active' => 0]);
                        } elseif ($object->tipo == 2) {
                            $this->anuncio->update_payment($object->payment_id, ['destacado' => 0]);
                        } elseif ($object->tipo == 3) {
                            $this->subasta->update_subasta_user($object->payment_id, ['is_active' => 0]);
                            $subasta = $this->subasta->get_intevalo_by_id($object->id);
                            $count = count($subasta);
                            if ((int) $subasta[$count - 1]->cantidad == 0) {
                                $this->subasta->update($object->id, ['is_open' => 1]);
                            }

                            $cantidad = (int) $subasta[$count - 1]->cantidad + 1;
                            $this->subasta->update_intervalo($subasta[$count - 1]->intervalo_subasta_id, ['cantidad' => $cantidad]);
                        }

                        echo json_encode(['status' => 500, 'mensaje' => $response->status->message, 'estado' => $response->status->status]);
                    } else {
                        $this->payment->update($object->payment_id, ['estado_reverso' => 2]);
                        echo json_encode(['status' => 404]);
                    }
                } else {
                    $this->payment->update($object->payment_id, ['estado_reverso' => 2]);
                    echo json_encode(['status' => 200]);
                }
                exit();
            } else {
                //estado_reverso==2 reverso manueal
                $this->payment->update($object->payment_id, ['estado_reverso' => 2]);

                echo json_encode(['status' => 200]);
                exit();
            }
        } else {
            $this->payment->update($object->payment_id, ['estado_reverso' => 2]);
            echo json_encode(['status' => 200]);
        }
        exit();
    }
}
