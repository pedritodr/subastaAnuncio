<?php
class Cron  extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();


        $this->load->model('Membresia_model', 'membresia');
        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Subasta_model', 'subasta');
        $this->load->model('payment_model', 'payment');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");
    }

    public function subasta_inversa()
    {
        require(APPPATH . "libraries/Curl.php");

        //  $fecha_hoy = date('Y-m-d');
        $fecha = strtotime(date("Y-m-d", time()));

        $cantidad_intervalos = 0;
        $all_subasta = $this->subasta->get_all(['is_active' => 1, 'tipo_subasta' => 2, 'is_open' => 1]);

        foreach ($all_subasta as $item) {
            if ($item->cantidad_dias > 0 && $item->intervalo > 0) {
                $cantidad_intervalos = round((int) $item->cantidad_dias / (int) $item->intervalo);
            }

            $result = $this->subasta->get_intevalo_by_id($item->subasta_id);
            if (count($result) <= $cantidad_intervalos) {
                $object = end($result);

                $fecha_cierre = strtotime($object->fecha);
                if ($object->cantidad > 0 && $fecha >= $fecha_cierre) {

                    $nuevafecha = strtotime('+' . $item->intervalo . ' day', $fecha);
                    $nuevafecha = date('Y-m-d', $nuevafecha);

                    $porcentaje = ((float) $item->porcentaje / 100) + 1;

                    $valor = (float) $object->valor / $porcentaje;

                    if ($valor > (float) $item->valor_minimo) {

                        $data = ['fecha' => $nuevafecha, 'cantidad' => $object->cantidad, 'subasta_id' => $object->subasta_id, 'valor' => $valor];

                        $this->subasta->create_intervalo($data);
                    }
                }
            }
        }
    }
    public function csm()
    {

        // header('Content-Type: image/jpeg');
        $mem =  $this->anuncio->get_by_id(42);

        define('UPLOAD_DIR', './uploads/pdfs/');
        $img = $mem->photo;
        $img = str_replace('data:image/jpeg;base64,', '', $img);

        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);

        $file = UPLOAD_DIR . uniqid() . '.jpg';
        $image = uniqid() . '.jpg';

        $success = file_put_contents($file, $data);


        function redimensionar_imagen($nombreimg, $rutaimg, $xmax, $ymax)
        {
            $ext = explode(".", $nombreimg);
            $ext = $ext[count($ext) - 1];

            if ($ext == "jpg" || $ext == "jpeg")

                $imagen = imagecreatefromjpeg($rutaimg);
            elseif ($ext == "png")
                $imagen = imagecreatefrompng($rutaimg);
            elseif ($ext == "gif")
                $imagen = imagecreatefromgif($rutaimg);

            $x = imagesx($imagen);
            $y = imagesy($imagen);

            if ($x <= $xmax && $y <= $ymax) {
                echo "<center>Esta imagen ya esta optimizada para los maximos que deseas.<center>";
                return $imagen;
            }

            if ($x >= $y) {
                $nuevax = $xmax;
                $nuevay = $nuevax * $y / $x;
            } else {
                $nuevay = $ymax;
                $nuevax = $x / $y * $nuevay;
            }

            $img2 = imagecreatetruecolor($nuevax, $nuevay);
            imagecopyresized($img2, $imagen, 0, 0, 0, 0, floor($nuevax), floor($nuevay), $x, $y);
            echo "<center>La imagen se ha optimizado correctamente.</center>";
            return $img2;
        }
        $imagen_optimizada = redimensionar_imagen($image, $file, 645, 645);
        imagejpeg($imagen_optimizada, $file);
    }
    public function actualizar_membresia()
    {
        $fecha = strtotime(date("Y-m-d H:i:00", time()));
        $date = strtotime(date("Y-m-d"));
        $fecha_mes = strtotime('+30 day', $fecha);
        $fecha_mes = date('Y-m-d', $fecha_mes);
        $all_membresias = $this->membresia->get_all_membresias_user(['estado' => 1]);
        foreach ($all_membresias as $item) {
            $fecha_fin = strtotime($item->fecha_fin);
            // $fechaEntera = strtotime($fecha_fin);
            /*     $anio = date("Y", $fechaEntera);
            $mes = date("m", $fechaEntera);
            $dia = date("d", $fechaEntera);
            $fecha_fin = $anio . "-" . $mes . "-" . $dia; */
            if ($fecha >= $fecha_fin) {
                $this->membresia->update_membresia_user($item->membre_user_id, ['estado' => 0]);
            }
            if (($item->mes < 12) && (strtotime($item->fecha_mes) == $date)) {
                $mes = (int) $item->mes + 1;
                $data = [
                    'anuncios_publi' => (int) $item->cant_anuncio,
                    'fecha_mes' => $fecha_mes,
                    'mes' => $mes
                ];
                $this->membresia->update_membresia_user($item->membre_user_id, $data);
            }
        }
    }
    public function desactivar_anuncio()
    {

        $fecha = strtotime(date("Y-m-d", time()));
        $all_anuncios = $this->anuncio->get_all(['is_active' => 1]);
        foreach ($all_anuncios as $item) {
            $fecha_fin = strtotime($item->fecha_vencimiento);

            if ($fecha >= $fecha_fin) {
                $this->anuncio->update($item->anuncio_id, ['is_active' => 0, 'is_delete' => 1]);
            }
        }
    }
    public function desactivar_subasta()
    {
        $fecha = strtotime(date("Y-m-d H:i:00", time()));
        $all_subastas = $this->subasta->get_all(['is_active' => 1]);
        foreach ($all_subastas as $item) {
            $fecha_cierre = strtotime($item->fecha_cierre);
            // $fecha_fin =  $item->fecha_cierre;
            /*
            $fechaEntera = strtotime($fecha_fin);
            $anio = date("Y", $fechaEntera);
            $mes = date("m", $fechaEntera);
            $dia = date("d", $fechaEntera);
            $fecha_fin = $anio . "-" . $mes . "-" . $dia; */
            if ($fecha >= $fecha_cierre) {
                $this->subasta->update($item->subasta_id, ['is_open' => 0]);
            }
        }
    }
    public function update_transacciones()
    {
        require(APPPATH . "libraries/PPM.php");
        $this->load->model('payment_model', 'payment');
        //  $this->payment->create_prueba(['data' => "sonda"]);
        require(APPPATH . "libraries/Curl.php");
        // $this->payment->create_prueba(['data' => "sonda"]);
        $transacciones = $this->payment->get_all_transaccion();
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

        foreach ($transacciones as $item) {
            $json = '{
                "auth": {
                    "login": "' . $login . '",
                    "seed": "' . $seed . '",
                    "nonce": "' . $nonce . '",
                    "tranKey": "' . $tranKey . '"
                }
            }';
            $url = $payment->end_ponit . 'api/session/' . $item->request_id;

            $curl = new Curl();
            $response = $curl->full_consulta_post($url, $json);

            if ($response) {
                if ($response->status->status == "APPROVED") {
                    $this->payment->update($item->payment_id, ['status' => 1]);
                    if ($item->tipo == 0) { //membresia

                        $user_id = $item->user_id;
                        $this->load->model('Membresia_model', 'membresia');
                        $object_membresia = $this->membresia->get_by_id($item->id);
                        $fecha = date('Y-m-d H:i:s');
                        $fecha_fin = strtotime('+364 day', strtotime($fecha));
                        $fecha_fin = date('Y-m-d H:i:s', $fecha_fin);
                        $fecha_mes = strtotime('+30 day', strtotime($fecha));
                        $fecha_mes = date('Y-m-d', $fecha_mes);
                        $data = [
                            'user_id' => $user_id,
                            'membresia_id' => $item->id,
                            'fecha_inicio' => $fecha,
                            'fecha_fin' => $fecha_fin,
                            'fecha_mes' => $fecha_mes,
                            'anuncios_publi' => (int) $object_membresia->cant_anuncio,
                            'qty_subastas' => (int) $object_membresia->qty_subastas,
                            'estado' => 1,
                            'mes' => 1,
                            'payment_id' => $item->payment_id
                        ];
                        $this->membresia->create_membresia_user($data);
                    } elseif ($item->tipo == 1) {
                        $user_id = $item->user_id;
                        $subasta_id = $item->id;
                        $this->load->model('Subasta_model', 'subasta');
                        $this->load->model('Membresia_model', 'membresia');
                        $membresia = $this->membresia->get_membresia_by_user_id($user_id);
                        if ($membresia) {
                            $qty = (int) $membresia->qty_subastas;
                            if ($qty > 0) {
                                $resta = $qty - 1;
                                $this->membresia->update_membresia_user($membresia->membresia_user_id, ['qty_subastas' => $resta]);
                            }
                        }
                        $data = [
                            'user_id' => $user_id,
                            'subasta_id' => $subasta_id,
                            'is_active' => 1,
                            'payment_id' => $item->payment_id
                        ];
                        $this->subasta->create_subasta_user($data);
                    } elseif ($item->tipo == 2) {
                        $this->load->model('Anuncio_model', 'anuncio');
                        $anuncio_id = $item->id;
                        $fecha = date('Y-m-d');
                        $fecha_fin = strtotime('+30 day', strtotime($fecha));
                        $this->anuncio->update($anuncio_id, ['destacado' => 1, 'fecha_vencimiento' => $fecha_fin, 'payment_id' => $item->payment_id]);
                    } elseif ($item->tipo == 3) {
                        $user_id = $item->user_id;
                        $subasta_id = $item->id;
                        $this->load->model('Subasta_model', 'subasta');
                        $subasta = $this->subasta->get_intervalo_subasta($subasta_id);
                        $count = count($subasta);
                        $cantidad = (int) $subasta[$count - 1]->cantidad - 1;
                        if ($cantidad == 0) {
                            $this->subasta->update($subasta_id, ['is_open' => 0]);
                        }
                        $this->subasta->update_intervalo($subasta[$count - 1]->intervalo_subasta_id, ['cantidad' => $cantidad]);
                        $data = [
                            'user_id' => $user_id,
                            'subasta_id' => $subasta_id,
                            'is_active' => 1,
                            'intervalo_subasta_id' => $subasta[$count - 1]->intervalo_subasta_id,
                            'payment_id' => $item->payment_id
                        ];
                        $this->subasta->create_subasta_user($data);
                    }
                } elseif ($response->status->status == "REJECTED") {
                    $this->payment->update($item->payment_id, ['status' => 2]);
                }
            }
        }
        /*  $this->load->model("Correo_model", "correo");
        $asunto = "Sonda";
        $motivo = 'Sonda';
        $mensaje = "<p><img style='width:209px;heigth:44px' src='https://subastanuncios.com/assets/logo_subasta.png'></p>";
        $mensaje .= "Ejecucion de sonda test";
        $mensaje .= "El equipo de SUBASTANUNCIOS";
        $this->correo->sent("pedro@datalabcenter.com", $mensaje, $asunto, $motivo); */
    }
    public function fechas()
    {
        $fecha = date('Y-m-d H:i:s');
        $dia = date("d", strtotime($fecha));

        var_dump($dia);
        die();
    }
    public function update_transacciones_app()
    {
        require(APPPATH . "libraries/PPM.php");
        $this->load->model('payment_model', 'payment');
        //$this->payment->create_prueba(['data' => "sonda"]);
        require(APPPATH . "libraries/Curl.php");
        //    $this->payment->create_prueba(['data' => "sonda"]);
        $transacciones = $this->payment->get_all_transaccion();
        //carga de credenciales.
        $payment = $this->payment->get_by_credenciales_app();
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

        foreach ($transacciones as $item) {
            $json = '{
                "auth": {
                    "login": "' . $login . '",
                    "seed": "' . $seed . '",
                    "nonce": "' . $nonce . '",
                    "tranKey": "' . $tranKey . '"
                }
            }';
            $url = $payment->end_ponit . 'api/session/' . $item->request_id;

            $curl = new Curl();
            $response = $curl->full_consulta_post($url, $json);

            if ($response) {
                if ($response->status->status == "APPROVED") {
                    $this->payment->update($item->payment_id, ['status' => 1]);
                    if ($item->tipo == 0) { //membresia

                        $user_id = $item->user_id;
                        $this->load->model('Membresia_model', 'membresia');
                        $object_membresia = $this->membresia->get_by_id($item->id);
                        $fecha = date('Y-m-d H:i:s');
                        $fecha_fin = strtotime('+364 day', strtotime($fecha));
                        $fecha_fin = date('Y-m-d H:i:s', $fecha_fin);
                        $fecha_mes = strtotime('+30 day', strtotime($fecha));
                        $fecha_mes = date('Y-m-d', $fecha_mes);
                        $data = [
                            'user_id' => $user_id,
                            'membresia_id' => $item->id,
                            'fecha_inicio' => $fecha,
                            'fecha_fin' => $fecha_fin,
                            'fecha_mes' => $fecha_mes,
                            'anuncios_publi' => (int) $object_membresia->cant_anuncio,
                            'qty_subastas' => (int) $object_membresia->qty_subastas,
                            'estado' => 1,
                            'mes' => 1,
                            'payment_id' => $item->payment_id
                        ];
                        $this->membresia->create_membresia_user($data);
                    } elseif ($item->tipo == 1) {
                        $user_id = $item->user_id;
                        $subasta_id = $item->id;
                        $this->load->model('Subasta_model', 'subasta');
                        $this->load->model('Membresia_model', 'membresia');
                        $membresia = $this->membresia->get_membresia_by_user_id($user_id);
                        if ($membresia) {
                            $qty = (int) $membresia->qty_subastas;
                            if ($qty > 0) {
                                $resta = $qty - 1;
                                $this->membresia->update_membresia_user($membresia->membresia_user_id, ['qty_subastas' => $resta]);
                            }
                        }
                        $data = [
                            'user_id' => $user_id,
                            'subasta_id' => $subasta_id,
                            'is_active' => 1,
                            'payment_id' => $item->payment_id
                        ];
                        $this->subasta->create_subasta_user($data);
                    } elseif ($item->tipo == 2) {
                        $this->load->model('Anuncio_model', 'anuncio');
                        $anuncio_id = $item->id;
                        $fecha = date('Y-m-d');
                        $fecha_fin = strtotime('+30 day', strtotime($fecha));
                        $this->anuncio->update($anuncio_id, ['destacado' => 1, 'fecha_vencimiento' => $fecha_fin, 'payment_id' => $item->payment_id]);
                    } elseif ($item->tipo == 3) {
                        $user_id = $item->user_id;
                        $subasta_id = $item->id;
                        $this->load->model('Subasta_model', 'subasta');
                        $subasta = $this->subasta->get_intervalo_subasta($subasta_id);
                        $count = count($subasta);
                        $cantidad = (int) $subasta[$count - 1]->cantidad - 1;
                        if ($cantidad == 0) {
                            $this->subasta->update($subasta_id, ['is_open' => 0]);
                        }
                        $this->subasta->update_intervalo($subasta[$count - 1]->intervalo_subasta_id, ['cantidad' => $cantidad]);
                        $data = [
                            'user_id' => $user_id,
                            'subasta_id' => $subasta_id,
                            'is_active' => 1,
                            'intervalo_subasta_id' => $subasta[$count - 1]->intervalo_subasta_id,
                            'payment_id' => $item->payment_id
                        ];
                        $this->subasta->create_subasta_user($data);
                    }
                } elseif ($response->status->status == "REJECTED") {
                    $this->payment->update($item->payment_id, ['status' => 2]);
                }
            }
        }
    }
    public function update_points()
    {
        $this->load->model('Tree_node_model', 'tree_node');
        $this->load->model('Wallet_model', 'wallet');
        $this->load->model('Transaction_model', 'transaction');
        $this->load->model('Membresia_model', 'membresia');
        $nodes = $this->tree_node->get_all(['is_culminated' => 0]);
        $fecha = date('Y-m-d H:i:s');
        foreach ($nodes as $node) {
            $wallet_cliente = $this->wallet->get_wallet_by_user_id($node->user_id);
            $membresia = $this->membresia->get_by_user_id($node->user_id);
            if ($membresia) {
                $pointToMoney = 0;
                $points_left = 0;
                $points_right = 0;
                $charged = 0;
                $points = 0;
                $monto = 0;
                $valid = true;
                if ($node->active == 0) {
                    if ($node->points_left > 0 && $node->points_right > 0) {
                        if ($node->points_left > $node->points_right) {
                            $pointToMoney = $node->points_right * 0.15;
                            $points_left = $node->points_left - $node->points_right;
                            $points_right = 0;
                            $charged = (float)$node->charged + $node->points_right;
                            $points = (float)$node->points + $node->points_right;
                        } else {
                            $pointToMoney = $node->points_left * 0.15;
                            $points_right = $node->points_right - $node->points_left;
                            $points_left = 0;
                            $charged = (float)$node->charged + $node->points_left;
                            $points = (float)$node->points + $node->points_left;
                        }
                    } else {
                        $valid = false;
                    }
                } else {
                    if ($node->points_left > 0 && $node->points_right > 0) {
                        if ($node->points_left > $node->points_right) {
                            $pointToMoney = $node->points_right * 0.15;
                            $points_left = $node->points_left - $node->points_right;
                            $points_right = 0;
                            $charged = (float)$node->charged + $node->points_right;
                            $points = (float)$node->points + $node->points_right;
                        } else {
                            $pointToMoney = $node->points_left * 0.15;
                            $points_right = $node->points_right - $node->points_left;
                            $points_left = 0;
                            $charged = (float)$node->charged + $node->points_left;
                            $points = (float)$node->points + $node->points_left;
                        }
                    } else {
                        $valid = false;
                    }
                }
                if ($valid) {
                    if ($membresia->type == 0) {
                        $totalPuntos = round((($membresia->precio * 2) + $membresia->precio) / 0.15);
                    } else {
                        $totalPuntos = round((($membresia->precio * 1.6) + $membresia->precio) / 0.15);
                    }
                    if ($points <= $totalPuntos) {
                        $data_node = [
                            'points_right' => $points_right,
                            'points_left' => $points_left,
                            'charged' => $charged,
                            'points' => $points,
                            'active' => 1
                        ];
                    } else {
                        $points = $points - $totalPuntos;
                        $data_node = [
                            'points_right' => $points_right,
                            'points_left' => $points_left,
                            'charged' => $charged,
                            'points' => $points,
                            'active' => 1,
                            'is_culminated' => 1
                        ];
                    }

                    $this->tree_node->update($node->tree_node_id, $data_node);
                    if ($wallet_cliente) {
                        $monto = (float)$wallet_cliente->balance + $pointToMoney;
                        $data_transactions = [
                            'date_create' => $fecha,
                            'amount' => $pointToMoney,
                            'wallet_send' =>  0,
                            'type' => 7,
                            'balance_previous' => $wallet_cliente->balance,
                            'balance' => $monto,
                            'wallet_receives' => $wallet_cliente->wallet_id,
                            'status' => 1
                        ];
                        $this->transaction->create($data_transactions);
                        $this->wallet->update($wallet_cliente->wallet_id, ['balance' => $monto]);
                    } else {
                        $data_wallet = [
                            'user_id' => $node->user_id,
                            'points' => 0,
                            'balance' => 0
                        ];
                        $wallet_id = $this->wallet->create($data_wallet);
                        if ($wallet_id > 0) {
                            $data_transactions = [
                                'date_create' => $fecha,
                                'amount' => $pointToMoney,
                                'wallet_send' =>  0,
                                'type' => 7,
                                'balance_previous' => 0,
                                'balance' => $pointToMoney,
                                'wallet_receives' => $wallet_id,
                                'status' => 1
                            ];
                            $this->transaction->create($data_transactions);
                            $this->wallet->update($wallet_id, ['balance' => $pointToMoney]);
                        }
                    }
                }
            }
        }
    }

    public function bono_inversionista()
    {
        $this->load->model('Tree_node_model', 'tree_node');
        $this->load->model('Wallet_model', 'wallet');
        $this->load->model('Transaction_model', 'transaction');
        $this->load->model('Membresia_model', 'membresia');
        $nodes = $this->tree_node->get_all(['is_culminated' => 0]);
        $fecha = date('Y-m-d H:i:s');
        foreach ($nodes as $node) {
            $wallet_cliente = $this->wallet->get_wallet_by_user_id($node->user_id);
            $membresia = $this->membresia->get_by_user_id($node->user_id);
            if ($membresia) {
                if ($membresia->type == 1) {
                    if ($wallet_cliente) {
                        $monto = (float)$wallet_cliente->balance + (float)$membresia->bono;
                        $data_transactions = [
                            'date_create' => $fecha,
                            'amount' =>  (float)$membresia->bono,
                            'wallet_send' =>  0,
                            'type' => 8,
                            'balance_previous' => $wallet_cliente->balance,
                            'balance' => $monto,
                            'wallet_receives' => $wallet_cliente->wallet_id,
                            'status' => 1
                        ];
                        $this->transaction->create($data_transactions);
                        $this->wallet->update($wallet_cliente->wallet_id, ['balance' => $monto]);
                    } else {
                        $data_wallet = [
                            'user_id' => $node->user_id,
                            'points' => 0,
                            'balance' => 0
                        ];
                        $wallet_id = $this->wallet->create($data_wallet);
                        if ($wallet_id > 0) {
                            $data_transactions = [
                                'date_create' => $fecha,
                                'amount' => (float)$membresia->bono,
                                'wallet_send' =>  0,
                                'type' => 7,
                                'balance_previous' => 0,
                                'balance' => (float)$membresia->bono,
                                'wallet_receives' => $wallet_id,
                                'status' => 1
                            ];
                            $this->transaction->create($data_transactions);
                            $this->wallet->update($wallet_id, ['balance' => (float)$membresia->bono]);
                        }
                    }
                }
            }
        }
    }
}
