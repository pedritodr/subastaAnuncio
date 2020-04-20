<?php
require(APPPATH . "libraries/PPM.php");
class Payment extends CI_Controller
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



        $all_payment = $this->payment->get_all();
        foreach ($all_payment as $item) {
            $item->user = $this->user->get_by_id($item->user_id);
        }
        $data['all_payment'] = $all_payment;
        $this->load_view_admin_g("payment/index", $data);
    }
    public function reverso()
    {
        $request_id = $this->input->post('request_id');
        //   $request_id = "155866";
        $object = $this->payment->get_by_request_id($request_id);

        $date = date("Y-m-d", strtotime($object->date));
        $date = date("Y-m-d H:i:00", strtotime($date . "23:59"));
        $fecha = date("Y-m-d H:i:00", time());
        if (strtotime($date) > strtotime($fecha)) {
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

        $length = 8;
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $nonce = '';
        for ($i = 0; $i < $length; $i++) {
            $nonce .= $characters[rand(0, $charactersLength - 1)];
        }

        $login = '6dd79d14d110adedc41f3fbab8e58461';
        $secretkey = 'h61ByK5IO930k2T8';
        $seed = Date("Y-m-d\TH:i:sP");
        $tranKey = base64_encode(sha1($nonce . $seed . $secretkey, true));
        $nonce = base64_encode($nonce);

        $json = '{
            "auth": {
                "login": "' . $login . '",
                "seed": "' . $seed . '",
                "nonce": "' . $nonce . '",
                "tranKey": "' . $tranKey . '"
            }

        }';
        // API URL to send data
        $url = 'https://test.placetopay.ec/redirection/api/session/155844';

        // curl initiate
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        // SET Method as a POST
        curl_setopt($ch, CURLOPT_POST, 1);

        // Pass user data in POST command
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute curl and assign returned data
        $response  = curl_exec($ch);

        // Close curl
        curl_close($ch);

        // See response if data is posted successfully or any error
        // print_r($response);
        $result = json_decode($response);
        var_dump($result);
        die();
        /*   var_dump($result->payment[0]->internalReference);
        die(); */
    }
}
