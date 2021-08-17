<?php

class Transaccion extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Wallet_model', 'wallet');
        $this->load->model('Transaction_model', 'transaction');
        $this->load->model('Transfer_model', 'transfer');
        $this->load->model('Membresia_model', 'membresia');
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
        $request = $this->transaction->get_all_transfers();
        $data['request'] = $request;
        $this->load_view_admin_g("transaction/index", $data);
    }
    public function delete()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => "No tiene permiso para realizar esta tarea"]);
            exit();
        }
        $transaction_id = $this->input->post('transaction_id');
        $user_id = $this->input->post('user_id');
        $this->load->model('Wallet_model', 'wallet');
        $this->load->model('Transaction_model', 'transaction');
        $obj_transaction = $this->transaction->get_by_id($transaction_id);
        $fecha = date('Y-m-d H:i:s');
        $wallet = $this->wallet->get_wallet_by_user_id($user_id);
        if ($wallet) {
            $balance = (float)$wallet->balance + (float)$obj_transaction->amount;
            $data_transactions = [
                'date_create' => $fecha,
                'amount' => number_format($obj_transaction->amount, 2),
                'wallet_send' =>  0,
                'type' => 6,
                'balance_previous' => $wallet->balance,
                'balance' => number_format($balance, 2),
                'wallet_receives' => $wallet->wallet_id,
                'status' => 1
            ];
            $this->transaction->create($data_transactions);
            $this->transaction->update($transaction_id, ['status' => 3]);
            $this->wallet->update($wallet->wallet_id, ['balance' => number_format($balance, 2)]);
            echo json_encode(['status' => 200, 'msj' => "Correcto"]);
            exit();
        } else {
            echo json_encode(['status' => 500, 'msj' => "Ocurrió un error vuelva a intentarlo"]);
            exit();
        }
    }
    public function confirmar()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => "No tiene permiso para realizar esta tarea"]);
            exit();
        }
        $transaction_id = $this->input->post('transaction_id');
        $this->load->model('Transaction_model', 'transaction');
        $obj_transaction = $this->transaction->get_by_id($transaction_id);
        if ($obj_transaction) {
            $this->transaction->update($transaction_id, ['status' => 2]);
            echo json_encode(['status' => 200, 'msj' => "Correcto"]);
            exit();
        } else {
            echo json_encode(['status' => 500, 'msj' => "Ocurrió un error vuelva a intentarlo"]);
            exit();
        }
    }

    public function index_request()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }
        $request = $this->transfer->get_all_requests();
        $data['request'] = $request;
        $this->load_view_admin_g("transaction/index_request", $data);
    }
    public function delete_transfer()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            echo json_encode(['status' => 500, 'msj' => "No tiene permiso para realizar esta tarea"]);
            exit();
        }
        $transaction_id = $this->input->post('transaction_id');
        $user_id = $this->input->post('user_id');
        $fecha = date('Y-m-d H:i:s');
        $data = [
            'date_update' => $fecha,
            'status' => 2
        ];
        $this->transfer->update($transaction_id, $data);
        echo json_encode(['status' => 200, 'msj' => "Correcto"]);
        exit();
    }
    public function asignar_membresia()
    {
        $this->load->model("User_model", "user");
        $this->load->model('Wallet_model', 'wallet');
        $this->load->model('Tree_node_model', 'tree_node');
        $this->load->model('Transaction_model', 'transaction');
        $user_id = $this->input->post('user_id');
        $cliente = $this->user->get_by_id($user_id);
        $membresia = $this->input->post('membresia_id');
        $transfer = $this->input->post('transaction_id');
        $object_membresia = $this->membresia->get_by_id($membresia);
        $fecha = date('Y-m-d H:i:s');
        $duracion = '+' . $object_membresia->duracion . ' day';
        $fecha_fin = strtotime($duracion, strtotime($fecha));
        $fecha_fin = date('Y-m-d H:i:s', $fecha_fin);
        $fecha_mes = strtotime('+30 day', strtotime($fecha));
        $fecha_mes = date('Y-m-d', $fecha_mes);
        if ($cliente->parent != 0) {
            $wallet_parent = $this->wallet->get_wallet_by_user_id($cliente->parent);
            $amount = (float)$object_membresia->precio * 0.20;
            $nodeParent = $this->tree_node->get_node_renovate_by_user_id($cliente->parent);
            //  var_dump($nodeParent);
            if ($nodeParent) {
                $pointsAds = (float)$nodeParent->points_ads;
                $pointsReferer = (float) $nodeParent->points_referer;
                $benefit = (float)$nodeParent->benefit;
                $points = (float)$nodeParent->points;
                $pointsToMoney = $points * 0.15;
                $totalPuntos = 0;
                if ($nodeParent->type == 1) {
                    $totalBeneficio = round($nodeParent->precio * 2);
                    $totalPuntos = round((($nodeParent->precio * 2)) / 0.15);
                } else {
                    $totalBeneficio = round($nodeParent->precio * 1.6);
                    $totalPuntos = round((($nodeParent->precio * 1.6)) / 0.15);
                }
                $totalAcumPlan = $pointsAds + $pointsReferer + $benefit + $pointsToMoney + $amount;

                if ($totalAcumPlan >= $totalBeneficio) {
                    $amountPermitido = $totalBeneficio - ($pointsAds + $pointsReferer + $benefit + $pointsToMoney);
                    $data_node = [
                        'points' => $totalPuntos,
                        'active' => 1,
                        'is_culminated' => 1,
                        'points_referer' => $amountPermitido
                    ];
                } else {
                    $amountPermitido = $amount;
                    $totalReferer =   $pointsReferer  + $amount;
                    $data_node = [
                        'active' => 1,
                        'points_referer' => $totalReferer
                    ];
                }
                $this->tree_node->update($nodeParent->tree_node_id, $data_node);
            }
            $data_transactions = [
                'date_create' => $fecha,
                'amount' => $amountPermitido,
                'wallet_send' => 0,
                'type' => 3,
            ];
            $wallet_id = 0;
            $balance = 0;
            if ($wallet_parent) {
                $wallet_id = $wallet_parent->wallet_id;
                $balance = (float)$wallet_parent->balance + $amountPermitido;
                $data_transactions['balance_previous'] = $wallet_parent->balance;
                $data_transactions['balance'] = $balance;
                $data_transactions['wallet_receives'] = $wallet_id;
            } else {
                $data_wallet = [
                    'user_id' => $cliente->parent,
                    'points' => 0,
                    'balance' => 0
                ];
                $wallet_id = $this->wallet->create($data_wallet);
                $data_transactions['balance_previous'] = 0;
                $data_transactions['balance'] = $amountPermitido;
                $data_transactions['wallet_receives'] = $wallet_id;
                $balance = $amountPermitido;
            }
            $this->transaction->create($data_transactions);
            $this->wallet->update($wallet_id, ['balance' => $balance]);
        }
        $data = [
            'user_id' => $user_id,
            'membresia_id' => $membresia,
            'fecha_inicio' => $fecha,
            'fecha_fin' => $fecha_fin,
            'fecha_mes' => $fecha_mes,
            'anuncios_publi' => (int) $object_membresia->cant_anuncio,
            'qty_subastas' => (int) $object_membresia->qty_subastas,
            'estado' => 1,
            'mes' => 1
        ];
        $valor = $this->membresia->create_membresia_user($data);
        if ($valor) {
            if ($cliente->parent == 0) {
                $data_node = [
                    'membre_user_id' => $valor,
                    'variable_config' => 0,
                    'is_active' => 1,
                    'is_delete' => 0,
                    'points_left' => 0,
                    'points_right' => 0,
                    'date_create' => $fecha,
                    'date_active' => $fecha,
                    'parent' => 0,
                    'position' => 0,
                    'user_id' => $user_id,
                    'is_culminated' => 0,
                    'points' => 0,
                    'charged' => 0,
                    'active' => 1,
                    'points_referer' => 0
                ];
                $this->tree_node->create($data_node);
            } else {
                $node_parent = $this->tree_node->get_node_by_user($cliente->user_id);

                if ($node_parent) {
                    $parent = $node_parent->parent;
                    $points = round($object_membresia->precio * 0.7);
                    do {
                        if ($parent == 0) {
                            $continue = false;
                        } else {
                            $nodeTemp = $this->tree_node->get_node_padre_by_id($parent);
                            $parent = $nodeTemp->parent;

                            if ($node_parent->position == 0) {
                                $childremsRight = $this->tree_node->get_all_children($nodeTemp->tree_node_id, 0);
                                if (count($childremsRight) > 0) {
                                    $pointsRight = (float)$nodeTemp->points_right + $points;
                                    $totalPointsRight = (float)$nodeTemp->total_point_right + $points;
                                    $data_node = [
                                        'points_right' => $pointsRight,
                                        'total_point_right' => $totalPointsRight
                                    ];
                                    $this->tree_node->update($nodeTemp->tree_node_id, $data_node);
                                }
                            } else {
                                $childremsLeft = $this->tree_node->get_all_children($nodeTemp->tree_node_id, 1);
                                if (count($childremsLeft) > 0) {
                                    $pointsLeft = (float)$nodeTemp->points_left + $points;
                                    $totalPointsLeft = (float)$nodeTemp->total_points_left + $points;
                                    $data_node = [
                                        'points_left' => $pointsLeft,
                                        'total_points_left' => $totalPointsLeft
                                    ];
                                    $this->tree_node->update($nodeTemp->tree_node_id, $data_node);
                                }
                            }

                            if ($parent > 0) {
                                $node_parent = $nodeTemp;
                            }
                            $continue = true;
                        }
                    } while ($continue);

                    $data_node = [
                        'membre_user_id' => $valor,
                        'is_active' => 1,
                        'date_active' => $fecha,
                        'active' => 1,
                        'points_referer' => 0
                    ];
                    $node_parent = $this->tree_node->get_node_by_user($cliente->user_id);
                    $this->tree_node->update($node_parent->tree_node_id, $data_node);
                } else {
                    $data_node = [
                        'membre_user_id' => $valor,
                        'variable_config' => 0,
                        'is_active' => 1,
                        'is_delete' => 0,
                        'points_left' => 0,
                        'points_right' => 0,
                        'date_create' => $fecha,
                        'date_active' => $fecha,
                        'parent' => 0,
                        'position' => 0,
                        'user_id' => $user_id,
                        'is_culminated' => 0,
                        'points' => 0,
                        'charged' => 0,
                        'active' => 1,
                        'points_referer' => 0
                    ];
                    $this->tree_node->create($data_node);
                }
            }
            $dataT = [
                'date_update' => $fecha,
                'status' => 1
            ];
            $this->transfer->update($transfer, $dataT);
        }
        $this->transfer->update($transfer, $dataT);
        $this->load->model("Correo_model", "correo");
        $asunto = "Membresia adquirida";
        $motivo = 'Membresia adquirida Subasta anuncios';
        $mensaje = "<p><img style='width:209px;heigth:44px' src='https://subastanuncios.com/assets/logo_subasta.png'></p>";
        $mensaje .= "<h3>Membresía “" . $object_membresia->nombre . "”</h3>";
        $mensaje .= "¡Felicitaciones! <br>Nos complace informarte que has adquirido una nueva membresía, mediante la cual tendrás acceso a los siguientes beneficios:<br>";
        $mensaje .= "" . $object_membresia->descripcion . "<br>";
        $mensaje .= "Tu usuario " . $cliente->email . ", tendrá activa esta membresía hasta " . $fecha_fin . ". Para seguir gestionando las ventajas de tu membresía, recuerda renovarla antes de cumplir la anualidad.<br>";
        $mensaje .= "Si necesitas contactar con nosotros puedes hacerlo a través del email comercial@suabastanuncios.com <br>";
        $mensaje .= "Gracias por sumarte a nuestra plataforma<br>";
        $mensaje .= "Saludos,<br>";
        $mensaje .= "El equipo de SUBASTANUNCIOS";
        $this->correo->sent($cliente->email, $mensaje, $asunto, $motivo);
        echo json_encode(['status' => 200, 'msj' => "Correcto"]);
        exit();
    }
    public function renovate_membership()
    {
        $this->load->model("User_model", "user");
        $this->load->model('Tree_node_model', 'tree_node');
        $this->load->model('Wallet_model', 'wallet');
        $this->load->model('Transaction_model', 'transaction');
        $user_id = $this->input->post('user_id');
        $membresiaUser = $this->membresia->get_membresia_by_user_id_transfer($user_id);
        if (!$membresiaUser) {
            echo json_encode(['status' => 500, 'msj' => "No se encontró la membresia asociada a este cliente"]);
            exit();
        }
        $cliente = $this->user->get_by_id($user_id);
        $membresia = $this->input->post('membresia_id');
        $transfer = $this->input->post('transfer_id');

        $membresiaUser = $membresiaUser->membre_user_id;
        $object_membresia = $this->membresia->get_by_id($membresia);
        $fecha = date('Y-m-d H:i:s');
        $duracion = '+' . $object_membresia->duracion . ' day';
        $fecha_fin = strtotime($duracion, strtotime($fecha));
        $fecha_fin = date('Y-m-d H:i:s', $fecha_fin);
        $fecha_mes = strtotime('+30 day', strtotime($fecha));
        $fecha_mes = date('Y-m-d', $fecha_mes);
        $node = $this->tree_node->get_node_renovate_by_user_id($cliente->user_id);
        if ($node) {
            $dataMembership = [
                'fecha_inicio' => $fecha,
                'fecha_fin' => $fecha_fin,
                'fecha_mes' => $fecha_mes,
                'anuncios_publi' => (int) $object_membresia->cant_anuncio,
                'qty_subastas' => (int) $object_membresia->qty_subastas,
                'estado' => 1,
                'mes' => 1
            ];
            $this->membresia->update_membresia_user($node->membre_user_id, $dataMembership);
            $dataNode = [
                'is_active' => 1,
                'active' => 1,
                'date_active' => $fecha,
                'points' => 0,
                'is_culminated' => 0,
                'points_ads' => 0,
                'benefit' => 0,
                'points_referer' => 0
            ];
            $this->tree_node->update($node->tree_node_id, $dataNode);
            //repartir puntos
            $node_parent = $this->tree_node->get_node_by_user($cliente->user_id);
            if ($node_parent) {
                $parent = $node_parent->parent;
                $points = round($object_membresia->precio * 0.7);
                do {
                    if ($parent == 0) {
                        $continue = false;
                    } else {
                        $nodeTemp = $this->tree_node->get_node_padre_by_id($parent);
                        $parent = $nodeTemp->parent;
                        if ($node_parent->position == 0) {
                            $childremsRight = $this->tree_node->get_all_children($nodeTemp->tree_node_id, 0);
                            if (count($childremsRight) > 0) {
                                $pointsRight = (float)$nodeTemp->points_right + $points;
                                $totalPointsRight = (float)$nodeTemp->total_point_right + $points;
                                $data_node = [
                                    'points_right' => $pointsRight,
                                    'total_point_right' => $totalPointsRight
                                ];
                                $this->tree_node->update($nodeTemp->tree_node_id, $data_node);
                            }
                        } else {
                            $childremsLeft = $this->tree_node->get_all_children($nodeTemp->tree_node_id, 1);
                            if (count($childremsLeft) > 0) {
                                $pointsLeft = (float)$nodeTemp->points_left + $points;
                                $totalPointsLeft = (float)$nodeTemp->total_points_left + $points;
                                $data_node = [
                                    'points_left' => $pointsLeft,
                                    'total_points_left' => $totalPointsLeft
                                ];
                                $this->tree_node->update($nodeTemp->tree_node_id, $data_node);
                            }
                        }
                        if ($parent > 0) {
                            $node_parent = $nodeTemp;
                        }
                        $continue = true;
                    }
                } while ($continue);
            }
            //comision
            $wallet_parent = $this->wallet->get_wallet_by_user_id($cliente->parent);
            $amount = (float)$object_membresia->precio * 0.20;
            $nodeParent = $this->tree_node->get_node_renovate_by_user_id($cliente->parent);
            if ($nodeParent) {
                $pointsAds = (float)$nodeParent->points_ads;
                $pointsReferer = (float) $nodeParent->points_referer;
                $benefit = (float)$nodeParent->benefit;
                $points = (float)$nodeParent->points;
                $pointsToMoney = $points * 0.15;
                $totalPuntos = 0;
                if ($nodeParent->type == 1) {
                    $totalBeneficio = round($nodeParent->precio * 2);
                    $totalPuntos = round((($nodeParent->precio * 2)) / 0.15);
                } else {
                    $totalBeneficio = round($nodeParent->precio * 1.6);
                    $totalPuntos = round((($nodeParent->precio * 1.6)) / 0.15);
                }
                $totalAcumPlan = $pointsAds + $pointsReferer + $benefit + $pointsToMoney + $amount;

                if ($totalAcumPlan >= $totalBeneficio) {
                    $amountPermitido = $totalBeneficio - ($pointsAds + $pointsReferer + $benefit + $pointsToMoney);
                    $data_node = [
                        'points' => $totalPuntos,
                        'active' => 1,
                        'is_culminated' => 1,
                        'points_referer' => $amountPermitido
                    ];
                } else {
                    $amountPermitido = $amount;
                    $totalReferer =   $pointsReferer  + $amount;
                    $data_node = [
                        'active' => 1,
                        'points_referer' => $totalReferer
                    ];
                }
                $this->tree_node->update($nodeParent->tree_node_id, $data_node);
            }
            $data_transactions = [
                'date_create' => $fecha,
                'amount' => $amountPermitido,
                'wallet_send' => 0,
                'type' => 3,
            ];
            $wallet_id = 0;
            $balance = 0;
            if ($wallet_parent) {
                $wallet_id = $wallet_parent->wallet_id;
                $balance = (float)$wallet_parent->balance + $amountPermitido;
                $data_transactions['balance_previous'] = $wallet_parent->balance;
                $data_transactions['balance'] = $balance;
                $data_transactions['wallet_receives'] = $wallet_id;
            } else {
                $data_wallet = [
                    'user_id' => $cliente->parent,
                    'points' => 0,
                    'balance' => 0
                ];
                $wallet_id = $this->wallet->create($data_wallet);
                $data_transactions['balance_previous'] = 0;
                $data_transactions['balance'] = $amountPermitido;
                $data_transactions['wallet_receives'] = $wallet_id;
                $balance = $amountPermitido;
            }
            $this->transaction->create($data_transactions);
            $this->wallet->update($wallet_id, ['balance' => $balance]);
        } else {

            $dataMembership = [
                'fecha_inicio' => $fecha,
                'fecha_fin' => $fecha_fin,
                'fecha_mes' => $fecha_mes,
                'anuncios_publi' => (int) $object_membresia->cant_anuncio,
                'qty_subastas' => (int) $object_membresia->qty_subastas,
                'estado' => 1,
                'mes' => 1
            ];
            $this->membresia->update_membresia_user($membresiaUser, $dataMembership);
            if ($cliente->parent != 0) {
                $nodeParent = $this->tree_node->get_node_renovate_by_user_id($cliente->parent);
                $data_node = [
                    'membre_user_id' => $membresiaUser,
                    'variable_config' => 0,
                    'is_active' => 1,
                    'is_delete' => 0,
                    'points_left' => 0,
                    'points_right' => 0,
                    'total_points_left' => 0,
                    'total_point_right' => 0,
                    'date_create' => date('Y-m-d H:i:s'),
                    'date_active' => date('Y-m-d H:i:s'),
                    'parent' => $nodeParent->tree_node_id,
                    'user_id' => $user_id,
                    'is_culminated' => 0,
                    'points' => 0,
                    'charged' => 0,
                    'active' => 1,
                    'points_ads' => 0,
                    'benefit' => 0,
                    'points_referer' => 0
                ];
                $node ? $data_node['position'] = $node->variable_config : $data_node['position'] = 0;
                $this->tree_node->create($data_node);
            } else {
                $emailAdmid = '';
                if (ENVIRONMENT == "development") {
                    $emailAdmid = 'pedroduran014@gmail.com';
                }
                if (ENVIRONMENT == "production") {
                    $emailAdmid = 'comercial@subastanuncios.com';
                }
                $admin  = $this->user->get_user_by_email_active($emailAdmid);
                if ($admin) {
                    $wallet_parent = $this->wallet->get_wallet_by_user_id($admin->user_id);
                    $amount = (float)$object_membresia->precio * 0.20;
                    $nodeParent = $this->tree_node->get_node_renovate_by_user_id($admin->user_id);
                    if ($nodeParent) {
                        $pointsAds = (float)$nodeParent->points_ads;
                        $pointsReferer = (float) $nodeParent->points_referer;
                        $benefit = (float)$nodeParent->benefit;
                        $points = (float)$nodeParent->points;
                        $pointsToMoney = $points * 0.15;
                        $totalPuntos = 0;
                        if ($nodeParent->type == 1) {
                            $totalBeneficio = round($nodeParent->precio * 2);
                            $totalPuntos = round((($nodeParent->precio * 2)) / 0.15);
                        } else {
                            $totalBeneficio = round($nodeParent->precio * 1.6);
                            $totalPuntos = round((($nodeParent->precio * 1.6)) / 0.15);
                        }
                        $totalAcumPlan = $pointsAds + $pointsReferer + $benefit + $pointsToMoney + $amount;

                        if ($totalAcumPlan >= $totalBeneficio) {
                            $amountPermitido = $totalBeneficio - ($pointsAds + $pointsReferer + $benefit + $pointsToMoney);
                            $data_node = [
                                'points' => $totalPuntos,
                                'active' => 1,
                                'is_culminated' => 1,
                                'points_referer' => $amountPermitido
                            ];
                        } else {
                            $amountPermitido = $amount;
                            $totalReferer =   $pointsReferer  + $amount;
                            $data_node = [
                                'active' => 1,
                                'points_referer' => $totalReferer
                            ];
                        }
                        $this->tree_node->update($nodeParent->tree_node_id, $data_node);
                    }
                    $data_transactions = [
                        'date_create' => $fecha,
                        'amount' => $amountPermitido,
                        'wallet_send' => 0,
                        'type' => 3,
                    ];
                    $wallet_id = 0;
                    $balance = 0;
                    if ($wallet_parent) {
                        $wallet_id = $wallet_parent->wallet_id;
                        $balance = (float)$wallet_parent->balance + $amountPermitido;
                        $data_transactions['balance_previous'] = $wallet_parent->balance;
                        $data_transactions['balance'] = $balance;
                        $data_transactions['wallet_receives'] = $wallet_id;
                    } else {
                        $data_wallet = [
                            'user_id' => $admin->user_id,
                            'points' => 0,
                            'balance' => 0
                        ];
                        $wallet_id = $this->wallet->create($data_wallet);
                        $data_transactions['balance_previous'] = 0;
                        $data_transactions['balance'] = $amountPermitido;
                        $data_transactions['wallet_receives'] = $wallet_id;
                        $balance = $amountPermitido;
                    }
                    $this->transaction->create($data_transactions);
                    $this->wallet->update($wallet_id, ['balance' => $balance]);

                    $node = $this->tree_node->get_node_row_by_user_id($admin->user_id);
                    $data_node = [
                        'membre_user_id' => $membresiaUser,
                        'variable_config' => 0,
                        'is_active' => 0,
                        'is_delete' => 0,
                        'points_left' => 0,
                        'points_right' => 0,
                        'date_create' => date('Y-m-d H:i:s'),
                        'parent' => $node->tree_node_id,
                        'user_id' => $user_id,
                        'is_culminated' => 0,
                        'points_referer' => 0,
                        'points_ads' => 0,
                        'benefit' => 0,
                        'points' => 0
                    ];
                    $node ? $data_node['position'] = $node->variable_config : $data_node['position'] = 0;
                    $this->tree_node->create($data_node);
                    $this->user->update($user_id, ['parent' => $admin->user_id]);
                } else {
                    $data_node = [
                        'membre_user_id' => $membresiaUser,
                        'variable_config' => 0,
                        'is_active' => 1,
                        'is_delete' => 0,
                        'points_left' => 0,
                        'points_right' => 0,
                        'total_points_left' => 0,
                        'total_point_right' => 0,
                        'date_create' => date('Y-m-d H:i:s'),
                        'date_active' => date('Y-m-d H:i:s'),
                        'parent' => 0,
                        'user_id' => $user_id,
                        'is_culminated' => 0,
                        'points' => 0,
                        'charged' => 0,
                        'position' => 0,
                        'active' => 1,
                        'points_ads' => 0,
                        'benefit' => 0,
                        'points_referer' => 0
                    ];
                    $this->tree_node->create($data_node);
                }
            }
        }
        $dataT = [
            'date_update' => $fecha,
            'status' => 1
        ];
        $this->transfer->update($transfer, $dataT);
        $this->load->model("Correo_model", "correo");
        $asunto = "Membresia adquirida";
        $motivo = 'Membresia adquirida Subasta anuncios';
        $mensaje = "<p><img style='width:209px;heigth:44px' src='https://subastanuncios.com/assets/logo_subasta.png'></p>";
        $mensaje .= "<h3>Membresía “" . $object_membresia->nombre . "”</h3>";
        $mensaje .= "¡Felicitaciones! <br>Nos complace informarte que has adquirido una nueva membresía, mediante la cual tendrás acceso a los siguientes beneficios:<br>";
        $mensaje .= "" . $object_membresia->descripcion . "<br>";
        $mensaje .= "Tu usuario " . $cliente->email . ", tendrá activa esta membresía hasta " . $fecha_fin . ". Para seguir gestionando las ventajas de tu membresía, recuerda renovarla antes de cumplir la anualidad.<br>";
        $mensaje .= "Si necesitas contactar con nosotros puedes hacerlo a través del email comercial@suabastanuncios.com <br>";
        $mensaje .= "Gracias por sumarte a nuestra plataforma<br>";
        $mensaje .= "Saludos,<br>";
        $mensaje .= "El equipo de SUBASTANUNCIOS";
        $this->correo->sent($cliente->email, $mensaje, $asunto, $motivo);

        echo json_encode(['status' => 200, 'msg' => "Membresia renovada correctamente"]);
        exit();
    }
    public function destacar_ads()
    {
        $this->load->model("User_model", "user");
        $this->load->model('Wallet_model', 'wallet');
        $this->load->model('Tree_node_model', 'tree_node');
        $this->load->model('Transaction_model', 'transaction');
        $this->load->model('Anuncio_model', 'anuncio');
        $user_id = $this->input->post('user_id');
        $cliente = $this->user->get_by_id($user_id);
        $ads_id = $this->input->post('ads_id');
        $transfer = $this->input->post('transaction_id');
        $object = $this->anuncio->get_by_id($ads_id);
        if (!$object) {
            echo json_encode(['status' => 500, 'msj' => "Anuncio no encontrado"]);
            exit();
        }
        $fecha = date('Y-m-d H:i:s');
        $fecha_fin = strtotime('+150 day', strtotime($fecha));
        $this->anuncio->update($ads_id, ['destacado' => 1, 'fecha_vencimiento' => $fecha_fin, 'payment_id' => $transfer]);
        $dataT = [
            'date_update' => $fecha,
            'status' => 1
        ];
        $this->transfer->update($transfer, $dataT);
        $this->load->model("Correo_model", "correo");
        $asunto = "Anuncio destacado";
        $motivo = 'Anuncio destacado Subasta anuncios';
        $mensaje = "<p><img style='width:209px;heigth:44px' src='https://subastanuncios.com/assets/logo_subasta.png'></p>";
        $mensaje .= "¡Felicitaciones! <br>Nos complace informarte que el anuncio : " . $object->titulo . " a sido destacado correctamente<br>";
        $mensaje .= "Si necesitas contactar con nosotros puedes hacerlo a través del email comercial@suabastanuncios.com <br>";
        $mensaje .= "Gracias por sumarte a nuestra plataforma<br>";
        $mensaje .= "Saludos,<br>";
        $mensaje .= "El equipo de SUBASTANUNCIOS";
        $this->correo->sent($cliente->email, $mensaje, $asunto, $motivo);
        echo json_encode(['status' => 200, 'msj' => "Correcto"]);
        exit();
    }
}
