<?php

class Membresia extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

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

        $all_membresia = $this->membresia->get_all(['is_delete' => 0]);
        $data['all_membresia'] = $all_membresia;
        $this->load_view_admin_g("membresia/index", $data);
    }
    public function asignar_membresia()
    {
        $this->load->model("User_model", "user");
        $this->load->model('Wallet_model', 'wallet');
        $this->load->model('Tree_node_model', 'tree_node');
        $this->load->model('Transaction_model', 'transaction');
        $user_id = $this->input->post('id_usuario');
        $cliente = $this->user->get_by_id($user_id);
        $membresia = $this->input->post('idmembresia');
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
                $benefit = $nodeParent->benefit + $amount;
                $pointBenefit =  $benefit / 0.15;
                $totalPuntos = 0;
                if ($nodeParent->type == 1) {
                    $totalPuntos = round((($nodeParent->precio * 2)) / 0.15);
                } else {
                    $totalPuntos = round((($nodeParent->precio * 1.6)) / 0.15);
                }
                $pointsAds = $nodeParent->points_ads;
                $qtyAds = $pointsAds / 20;
                $poinsAds =  $qtyAds * 133.333333;
                $points = (float)$nodeParent->points  + $poinsAds + $pointBenefit;
                if ($points > $totalPuntos) {
                    $data_node = [
                        'points' => $totalPuntos,
                        'active' => 1,
                        'is_culminated' => 1,
                        'benefit' => $benefit
                    ];
                } else {
                    $data_node = [
                        'active' => 1,
                        'benefit' => $benefit
                    ];
                }
                $this->tree_node->update($nodeParent->tree_node_id, $data_node);
            }
            $data_transactions = [
                'date_create' => $fecha,
                'amount' => $amount,
                'wallet_send' => 0,
                'type' => 3,
            ];
            $wallet_id = 0;
            $balance = 0;
            if ($wallet_parent) {
                $wallet_id = $wallet_parent->wallet_id;
                $balance = (float)$wallet_parent->balance + $amount;
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
                $data_transactions['balance'] = $amount;
                $data_transactions['wallet_receives'] = $wallet_id;
                $balance = $amount;
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
                    'active' => 1
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
                        'active' => 1
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
                        'active' => 1
                    ];
                    $this->tree_node->create($data_node);
                }
            }
        }

        $this->response->set_message("Membresia asignada correctamente.", ResponseMessage::SUCCESS);
        redirect("user/detalles/" . $user_id);
    }
    public function index_usuarios()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }
        $this->load->model('Pais_model', 'pais');
        $this->load->model('Tree_node_model', 'tree_node');
        $all_users = $this->membresia->get_all_membresias_users();
        foreach ($all_users as $item) {
            $item->ciudad = $this->pais->get_by_ciudad_id_object($item->ciudad_id);
            $item->node = $this->tree_node->get_node_renovate_by_user_id($item->user_id);
        }
        $data['all_users'] = $all_users;
        $this->load_view_admin_g("membresia/index_usuario", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $this->load_view_admin_g('membresia/add');
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $nombre = $this->input->post('nombre');
        $precio = $this->input->post('precio');
        $cant_anuncio = $this->input->post('cant_anuncio');
        $descuento = $this->input->post('descuento');
        $sorteo = $this->input->post('sorteo');
        $descripcion = $this->input->post('descripcion');
        $subastas = $this->input->post('subastas');
        $duracion = $this->input->post('duracion');
        $type = $this->input->post('type');
        $bono = $this->input->post('bono');
        $order = $this->input->post('order');
        $color = $this->input->post('color');
        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre', translate('nombre_lang'), 'required');


        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("membresia/add_index", "location", 301);
        } else { //en caso de que todo este bien


            $data = [
                'nombre' => $nombre,
                'precio' => $precio,
                'cant_anuncio' => $cant_anuncio,
                'descuento' => $descuento,
                'sorteo' => $sorteo,
                'descripcion' => $descripcion,
                'qty_subastas' => $subastas,
                'duracion' => $duracion,
                'type' => $type,
                'bono' => $bono,
                'is_delete' => 0,
                'orden' => $order,
                'color' => $color
            ];
            $this->membresia->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("membresia/index");
        }
    }

    function update_index($membresia_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $membresia_object = $this->membresia->get_by_id($membresia_id);

        if ($membresia_object) {
            $data['membresia_object'] = $membresia_object;
            $this->load_view_admin_g('membresia/update', $data);
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

        $membresia_id = $this->input->post('membresia_id');
        $nombre = $this->input->post('nombre');
        $precio = $this->input->post('precio');
        $cant_anuncio = $this->input->post('cant_anuncio');
        $descuento = $this->input->post('descuento');
        $sorteo = $this->input->post('sorteo');
        $descripcion = $this->input->post('descripcion');
        $subastas = $this->input->post('subastas');
        $duracion = $this->input->post('duracion');
        $type = $this->input->post('type');
        $bono = $this->input->post('bono');
        $order = $this->input->post('order');
        $color = $this->input->post('color');
        $membresia_object = $this->membresia->get_by_id($membresia_id);

        if ($membresia_object) {

            $data_membresia = [
                'nombre' => $nombre,
                'precio' => $precio,
                'cant_anuncio' => $cant_anuncio,
                'membresia_id' => $membresia_id,
                'descuento' => $descuento,
                'sorteo' => $sorteo,
                'descripcion' => $descripcion,
                'qty_subastas' => $subastas,
                'duracion' => $duracion,
                'type' => $type,
                'bono' => $bono,
                'orden' => $order,
                'color' => $color
            ];
            $this->membresia->update($membresia_id, $data_membresia);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("membresia/index");
        } else {
            show_404();
        }
    }

    public function delete($membresia_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $membresia_object = $this->membresia->get_by_id($membresia_id);

        if ($membresia_object) {
            $this->membresia->update($membresia_id, ['is_delete' => 1]);
            // $this->membresia->delete($membresia_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("membresia/index");
        } else {
            show_404();
        }
    }

    public function renovate_membership()
    {
        $this->load->model("User_model", "user");
        $this->load->model('Tree_node_model', 'tree_node');
        $this->load->model('Wallet_model', 'wallet');
        $this->load->model('Transaction_model', 'transaction');
        $user_id = $this->input->post('idUser');
        $cliente = $this->user->get_by_id($user_id);
        $membresia = $this->input->post('idMembership');
        $membresiaUser = $this->input->post('idMembershipUser');
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
                $benefit = $nodeParent->benefit + $amount;
                $pointBenefit =  $benefit / 0.15;
                $totalPuntos = 0;
                if ($nodeParent->type == 1) {
                    $totalPuntos = round((($nodeParent->precio * 2)) / 0.15);
                } else {
                    $totalPuntos = round((($nodeParent->precio * 1.6)) / 0.15);
                }
                $pointsAds = $nodeParent->points_ads;
                $qtyAds = $pointsAds / 20;
                $poinsAds =  $qtyAds * 133.333333;
                $points = (float)$nodeParent->points  + $poinsAds + $pointBenefit;
                if ($points > $totalPuntos) {
                    $data_node = [
                        'points' => $totalPuntos,
                        'active' => 1,
                        'is_culminated' => 1,
                        'benefit' => $benefit
                    ];
                } else {
                    $data_node = [
                        'active' => 1,
                        'benefit' => $benefit
                    ];
                }
                $this->tree_node->update($nodeParent->tree_node_id, $data_node);
            }
            $data_transactions = [
                'date_create' => $fecha,
                'amount' => $amount,
                'wallet_send' => 0,
                'type' => 3,
            ];
            $wallet_id = 0;
            $balance = 0;
            if ($wallet_parent) {
                $wallet_id = $wallet_parent->wallet_id;
                $balance = (float)$wallet_parent->balance + $amount;
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
                $data_transactions['balance'] = $amount;
                $data_transactions['wallet_receives'] = $wallet_id;
                $balance = $amount;
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
                        $benefit = $nodeParent->benefit + $amount;
                        $pointBenefit =  $benefit / 0.15;
                        $totalPuntos = 0;
                        if ($nodeParent->type == 1) {
                            $totalPuntos = round((($nodeParent->precio * 2)) / 0.15);
                        } else {
                            $totalPuntos = round((($nodeParent->precio * 1.6)) / 0.15);
                        }
                        $pointsAds = $nodeParent->points_ads;
                        $qtyAds = $pointsAds / 20;
                        $poinsAds =  $qtyAds * 133.333333;
                        $points = (float)$nodeParent->points  + $poinsAds + $pointBenefit;
                        if ($points > $totalPuntos) {
                            $data_node = [
                                'points' => $totalPuntos,
                                'active' => 1,
                                'is_culminated' => 1,
                                'benefit' => $benefit
                            ];
                        } else {
                            $data_node = [
                                'active' => 1,
                                'benefit' => $benefit
                            ];
                        }
                        $this->tree_node->update($nodeParent->tree_node_id, $data_node);
                    }
                    $data_transactions = [
                        'date_create' => $fecha,
                        'amount' => $amount,
                        'wallet_send' => 0,
                        'type' => 3,
                    ];
                    $wallet_id = 0;
                    $balance = 0;
                    if ($wallet_parent) {
                        $wallet_id = $wallet_parent->wallet_id;
                        $balance = (float)$wallet_parent->balance + $amount;
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
                        $data_transactions['balance'] = $amount;
                        $data_transactions['wallet_receives'] = $wallet_id;
                        $balance = $amount;
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
                        'is_culminated' => 0
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
                    ];
                    $this->tree_node->create($data_node);
                }
            }
        }

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

    public function createArbolMembership()
    {
        $this->load->model('Tree_node_model', 'tree_node');
        $all_users = $this->membresia->get_all_membresias_users();
        $fecha = date('Y-m-d H:i:s');
        foreach ($all_users as $item) {
            $node = $this->tree_node->get_node_renovate_by_user_id($item->user_id);
            if ($node) {
                if ($item->parent == 0) {
                    $data_node = [
                        'membre_user_id' => $item->membre_user_id,
                        'variable_config' => 0,
                        'is_active' => 1,
                        'is_delete' => 0,
                        'points_left' => 0,
                        'points_right' => 0,
                        'date_create' => $fecha,
                        'date_active' => $fecha,
                        'parent' => 0,
                        'position' => 0,
                        'user_id' => $item->user_id,
                        'is_culminated' => 0,
                        'points' => 0,
                        'charged' => 0,
                        'active' => 1
                    ];
                    $this->tree_node->create($data_node);
                } else {
                    $node_parent = $this->tree_node->get_node_by_user($item->parent);
                    if ($node_parent) {
                        $data_node = [
                            'membre_user_id' => $item->membre_user_id,
                            'variable_config' => 0,
                            'is_active' => 1,
                            'is_delete' => 0,
                            'points_left' => 0,
                            'points_right' => 0,
                            'date_create' => $fecha,
                            'date_active' => $fecha,
                            'parent' => $node_parent->tree_node_id,
                            'position' => 0,
                            'user_id' => $item->user_id,
                            'is_culminated' => 0,
                            'points' => 0,
                            'charged' => 0,
                            'active' => 1
                        ];
                        $this->tree_node->create($data_node);
                    } else {
                        $data_node = [
                            'membre_user_id' => $item->membre_user_id,
                            'variable_config' => 0,
                            'is_active' => 1,
                            'is_delete' => 0,
                            'points_left' => 0,
                            'points_right' => 0,
                            'date_create' => $fecha,
                            'date_active' => $fecha,
                            'parent' => 0,
                            'position' => 0,
                            'user_id' => $item->user_id,
                            'is_culminated' => 0,
                            'points' => 0,
                            'charged' => 0,
                            'active' => 1
                        ];
                        $this->tree_node->create($data_node);
                    }
                }
            }
        }
        $data['all_users'] = $all_users;
        var_dump($data);
        die();
    }
}
