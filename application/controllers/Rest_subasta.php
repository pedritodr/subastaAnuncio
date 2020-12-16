<?php
require(APPPATH . "libraries/REST_Controller.php");
require(APPPATH . "libraries/DatalabSecurity.php");
//require(APPPATH . "libraries/proveedores/AlignetWallet.php");
class Rest_subasta extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Subasta_model', 'subasta');
        $this->load->model('User_model', 'user');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }


    public function subastas_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');

        $auth = $this->user->is_valid_auth($user_id, $security_token);

        if ($auth) {
            $all_subasta = $this->subasta->get_all(['is_active' => 1]);

            $this->load->model("Categoria_model", "categoria");
            $this->load->model('Pais_model', 'pais');
            foreach ($all_subasta as $item) {
                $categoria_object = $this->categoria->get_by_id($item->categoria_id);
                $item->categoria = $categoria_object;

                $ciudad_object = $this->pais->get_by_ciudad_id_object($item->ciudad_id);
                $item->ciudad = $ciudad_object;
            }
            if ($all_subasta) {

                $this->response(['status' => 200, 'lista' => $all_subasta]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }

    public function cargar_subastas_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $limite = $this->input->post('limite');
        $tipo = $this->input->post('tipo');
        $limite = 11;
        $comienza = $this->input->post('comienza');
        $infinito = false;
        if ($comienza > 0) {
            $infinito = true;
        }
        $auth = $this->user->is_valid_auth($user_id, $security_token);

        if ($auth) {
            $fecha = strtotime(date("Y-m-d H:i:00", time()));
            $all_subasta = $this->subasta->get_all_by_subastas_with_pagination2($limite, $comienza, $fecha, $tipo);
            $this->load->model("Categoria_model", "categoria");
            $this->load->model('Pais_model', 'pais');
            $subastas = [];
            foreach ($all_subasta as $item) {
                $title = strlen($item->nombre_espa);
                $categoria_object = $this->categoria->get_by_id($item->categoria_id);
                $item->categoria = $categoria_object;
                $ciudad_object = $this->pais->get_by_ciudad_id_object($item->ciudad_id);
                $item->ciudad = $ciudad_object;
                if ($title > 19) {
                    $item->nombre_espa = substr($item->nombre_espa, 0, 16) . "...";
                } else {
                    $item->nombre_espa = $item->nombre_espa;
                }
                if ($item->tipo_subasta == 2) {
                    $item->intervalo = $this->subasta->get_intervalo_subasta($item->subasta_id);
                    if ($item->intervalo) {
                        $intervalo = $item->intervalo[count($item->intervalo) - 1];
                        if ($intervalo->cantidad > 0) {
                            array_push($subastas, $item);
                        }
                    }
                } else {
                    $subasta_user =  $this->subasta->get_subasta_user($user_id, $item->subasta_id);
                    $puja =  $this->subasta->get_puja_alta($item->subasta_id);

                    if ($subasta_user) {
                        $puja_user = $this->subasta->get_puja_alta_user($item->subasta_id, $user_id);
                    } else {
                        $subasta_user = null;
                        $puja_user = null;
                    }
                    $puja =  $this->subasta->get_puja_alta($item->subasta_id);
                    if ($puja) {
                        $user_win = $this->subasta->get_puja_alta_obj($item->subasta_id);
                        if ($user_win) {
                            $user_win->surname = substr($user_win->surname, 0, 4) . "...";
                        }
                    } else {
                        $user_win = null;
                    }
                    $item->puja_win = $puja;
                    $item->user_win = $user_win;
                    $item->puja_user = $puja_user;
                    $item->subasta_user = $subasta_user;
                    array_push($subastas, $item);
                }
            }
            if ($subastas) {

                $this->response(['status' => 200, 'lista' => $subastas]);
            } else {
                $this->response(['status' => 404, 'infinito' => $infinito]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function all_subastas_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $auth = $this->user->is_valid_auth($user_id, $security_token);

        if ($auth) {
            $fecha = strtotime(date("Y-m-d H:i:00", time()));
            $all_subasta = $this->subasta->get_all_by_subastas_rest();

            $this->load->model("Categoria_model", "categoria");
            $this->load->model('Pais_model', 'pais');
            $subastas = [];
            foreach ($all_subasta as $item) {
                $title = strlen($item->nombre_espa);
                $categoria_object = $this->categoria->get_by_id($item->categoria_id);
                $item->categoria = $categoria_object;
                $ciudad_object = $this->pais->get_by_ciudad_id_object($item->ciudad_id);
                $item->ciudad = $ciudad_object;
                if ($title > 19) {
                    $item->nombre_espa = substr($item->nombre_espa, 0, 16) . "...";
                } else {
                    $item->nombre_espa = $item->nombre_espa;
                }
                $subasta_user =  $this->subasta->get_subasta_user($user_id, $item->subasta_id);
                $puja =  $this->subasta->get_puja_alta($item->subasta_id);

                if ($subasta_user) {
                    $puja_user = $this->subasta->get_puja_alta_user($item->subasta_id, $user_id);
                } else {
                    $subasta_user = null;
                    $puja_user = null;
                }
                $puja =  $this->subasta->get_puja_alta($item->subasta_id);
                if ($puja) {
                    $user_win = $this->subasta->get_puja_alta_obj($item->subasta_id);
                    if ($user_win) {
                        $user_win->surname = substr($user_win->surname, 0, 4) . "...";
                    }
                } else {
                    $user_win = null;
                }
                $item->puja_win = $puja;
                $item->user_win = $user_win;
                $item->puja_user = $puja_user;
                $item->subasta_user = $subasta_user;
                array_push($subastas, $item);
            }
            $this->response(['status' => 200, 'lista' => $subastas]);
            if ($subastas) {
                $this->response(['status' => 200, 'lista' => $subastas]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function cargar_subastas2_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $limite = $this->input->post('limite');
        $limite = 11;
        $comienza = $this->input->post('comienza');
        $id = $this->input->post('id');
        $auth = $this->user->is_valid_auth($user_id, $security_token);

        if ($auth) {
            $all_subasta = $this->subasta->get_all_by_subastas_with_pagination3($limite, $comienza, $id);

            $this->load->model("Categoria_model", "categoria");
            $this->load->model('Pais_model', 'pais');
            foreach ($all_subasta as $item) {
                $categoria_object = $this->categoria->get_by_id($item->categoria_id);
                $item->categoria = $categoria_object;

                $ciudad_object = $this->pais->get_by_ciudad_id_object($item->ciudad_id);
                $item->ciudad = $ciudad_object;
            }
            if ($all_subasta) {

                $this->response(['status' => 200, 'lista' => $all_subasta]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }

    public function detalle_subasta_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $subasta_id = $this->input->post('id');
        $subasta_user_id = $this->input->post('subasta_user_id');
        $auth = $this->user->is_valid_auth($user_id, $security_token);

        if ($auth) {
            $this->load->model('Categoria_model', 'categoria');
            $this->load->model('Pais_model', 'pais');
            $all_detalle = $this->subasta->get_by_id($subasta_id);
            $ciudad = $this->pais->get_by_ciudad_id_object($all_detalle->ciudad_id);
            $categoria = $this->categoria->get_by_id($all_detalle->categoria_id);
            if ($all_detalle->tipo_subasta == 2) {
                $all_detalle->intervalo = $this->subasta->get_intervalo_subasta($all_detalle->subasta_id);
                if ($all_detalle->intervalo) {
                    $all_detalle->intervalo = $all_detalle->intervalo[count($all_detalle->intervalo) - 1];
                }
                if ($subasta_user_id > 0) {
                    $all_detalle->wim_inversa = $this->subasta->get_by_intervalo_id_row($subasta_user_id);
                } else {
                    $all_detalle->wim_inversa = NULL;
                }
            } else {
                $all_detalle->wim_inversa = NULL;
            }
            $foto_object = $this->subasta->get_by_subasta_id($subasta_id);
            $subasta_user =  $this->subasta->get_subasta_user($user_id, $subasta_id);
            $subcat = $this->categoria->get_subcat_by_id($all_detalle->subcat_id);
            $puja =  $this->subasta->get_puja_alta($subasta_id);

            if ($subasta_user) {
                $puja_user = $this->subasta->get_puja_alta_user($subasta_id, $user_id);
            } else {
                $subasta_user = null;
                $puja_user = null;
            }
            $puja =  $this->subasta->get_puja_alta($subasta_id);
            if ($puja) {
                $user_win = $this->subasta->get_puja_alta_obj($subasta_id);
            } else {
                $user_win = null;
            }

            if ($all_detalle) {
                $this->response(['status' => 200, 'detalle' => $all_detalle, 'puja_win' => $puja, 'user_win' => $user_win, 'puja_user' => $puja_user, 'subasta_user' => $subasta_user, 'foto_object' => $foto_object, 'ciudad' => $ciudad, 'categoria' => $categoria, 'subcategoria' => $subcat]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }

    public function buscar_subastas_post()
    {
        $this->load->model('Pais_model', 'pais');
        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $buscar = $this->input->post('buscar');
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        $tipo = $this->input->post('tipo');
        $ubicacion = $this->input->post('ubicacion');
        $ciudad = $this->input->post('ciudad');
        $categoria = $this->input->post('categoria');
        $subcategoria = $this->input->post('subcategoria');
        $infinito = false;
        $limite = 11;
        $comienza = $this->input->post('comienza');
        if ($comienza > 0) {
            $infinito = true;
        }
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        if ($auth) {
            if ($ubicacion) {
                $ciudad_obj = $this->pais->get_city($ubicacion);
                if ($ciudad_obj) {
                    $ciudad = $ciudad_obj->ciudad_id;
                } else {
                    $ciudad = 0;
                }
            }

            $fecha = strtotime(date("Y-m-d H:i:00", time()));
            $all_subasta = $this->subasta->search_by_name($limite, $comienza, $buscar, $tipo, $ciudad, $categoria, $subcategoria);
            $this->load->model("Categoria_model", "categoria");
            $subastas = [];
            foreach ($all_subasta as $item) {
                $title = strlen($item->nombre_espa);
                $categoria_object = $this->categoria->get_by_id($item->categoria_id);
                $item->categoria = $categoria_object;
                $ciudad_object = $this->pais->get_by_ciudad_id_object($item->ciudad_id);
                $item->ciudad = $ciudad_object;
                if ($title > 19) {
                    $item->nombre_espa = substr($item->nombre_espa, 0, 16) . "...";
                } else {
                    $item->nombre_espa = $item->nombre_espa;
                }
                if ($item->tipo_subasta == 2) {
                    $item->intervalo = $this->subasta->get_intervalo_subasta($item->subasta_id);
                    if ($item->intervalo) {
                        $intervalo = $item->intervalo[count($item->intervalo) - 1];
                        if ($intervalo->cantidad > 0) {
                            array_push($subastas, $item);
                        }
                    }
                } else {
                    $subasta_user =  $this->subasta->get_subasta_user($user_id, $item->subasta_id);
                    $puja =  $this->subasta->get_puja_alta($item->subasta_id);

                    if ($subasta_user) {
                        $puja_user = $this->subasta->get_puja_alta_user($item->subasta_id, $user_id);
                    } else {
                        $subasta_user = null;
                        $puja_user = null;
                    }
                    $puja =  $this->subasta->get_puja_alta($item->subasta_id);
                    if ($puja) {
                        $user_win = $this->subasta->get_puja_alta_obj($item->subasta_id);
                        if ($user_win) {
                            $user_win->surname = substr($user_win->surname, 0, 4) . "...";
                        }
                    } else {
                        $user_win = null;
                    }
                    $item->puja_win = $puja;
                    $item->user_win = $user_win;
                    $item->puja_user = $puja_user;
                    $item->subasta_user = $subasta_user;
                    array_push($subastas, $item);
                }
            }
            if ($subastas) {

                $this->response(['status' => 200, 'lista' => $subastas]);
            } else {
                $this->response(['status' => 404, 'infinito' => $infinito]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function subasta_categoria_post()
    {
        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');

        $auth = $this->user->is_valid_auth($user_id, $security_token);

        if ($auth) {
            $this->load->model('Categoria_model', 'categoria');

            $all_categorias = $this->categoria->get_all(['is_active' => 1]);

            if (count($all_categorias) > 0) {

                $this->response(['status' => 200, 'lista' => $all_categorias]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function entrar_subasta_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $subasta_id = $this->input->post('subasta_id');
        $auth = $this->user->is_valid_auth($user_id, $security_token);

        if ($auth) {

            $this->load->model('Categoria_model', 'categoria');

            $id = $this->subasta->create_subasta_user(['subasta_id' => $subasta_id, 'user_id' => $user_id, 'is_active' => 1]);
            $object = $this->subasta->get_by_subasta_user($id);
            if ($object) {
                $object_puja = $this->subasta->get_puja_alta($subasta_id);
                $this->response(['status' => 200, 'object' => $object, 'puja' =>  $object_puja]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function pujar_user_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $subasta_user_id = $this->input->post('subasta_user_id');
        $subasta_id = $this->input->post('subasta_id');
        $valor = $this->input->post('valor');
        $data = [
            'subasta_user_id' => $subasta_user_id,
            'fecha_hora' => date('Y-m-d H:i:s'),
            'valor' => $valor
        ];

        $auth = $this->user->is_valid_auth($user_id, $security_token);
        if ($auth) {

            $object_puja = $this->subasta->get_puja_alta($subasta_id);

            if ($object_puja->valor) {

                if ($valor > $object_puja->valor) {
                    $id = $this->subasta->create_puja($data);
                    $object = $this->subasta->get_by_puja_id($id);
                    if ($object) {
                        $user_win = $this->subasta->get_puja_alta_obj($subasta_id);
                        $this->response(['status' => 200, 'object' => $object, 'user_win' => $user_win]);
                    } else {
                        $this->response(['status' => 404]);
                    }
                } else {
                    $this->response(['status' => 300, 'object' => $object_puja]);
                }
            } else {

                $id = $this->subasta->create_puja($data);
                $object = $this->subasta->get_by_puja_id($id);
                if ($object) {
                    $user_win = $this->subasta->get_puja_alta_obj($subasta_id);
                    $this->response(['status' => 200, 'object' => $object, 'user_win' => $user_win]);
                } else {
                    $this->response(['status' => 404]);
                }
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function puja_alta_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $subasta_id = $this->input->post('subasta_id');
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        if ($auth) {
            $obj_subasta = $this->subasta->get_by_id($subasta_id);
            $subasta_user =  $this->subasta->get_subasta_user($user_id, $subasta_id);
            if ($subasta_user) {
                $puja_user = $this->subasta->get_puja_alta_user($subasta_id, $user_id);
            } else {
                $subasta_user = null;
                $puja_user = null;
            }
            $puja =  $this->subasta->get_puja_alta($subasta_id);
            if ($puja) {
                $user_win = $this->subasta->get_puja_alta_obj($subasta_id);
                if ($user_win) {
                    $user_win->surname = substr($user_win->surname, 0, 4) . "...";
                }
            } else {
                $user_win = null;
            }
            if ($subasta_user) {
                $this->response(['status' => 200, 'puja_win' => $puja, 'user_win' => $user_win, 'puja_user' => $puja_user, 'subasta' => $obj_subasta, 'subasta_user' => $subasta_user]);
            }
        } else {
            $this->response(['status' => 500]);
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
    public function pagar_entrada_post()
    {
        $this->load->model('Membresia_model', 'membresia');
        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $subasta_id = $this->input->post('subasta_id');
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        if ($auth) {
            $membresia = $this->membresia->get_membresia_by_user_id($user_id);
            if ($membresia) {
                $qty = (int) $membresia->qty_subastas;
                if ($qty > 0) {
                    $resta = $qty - 1;
                    $this->membresia->update_membresia_user($membresia->membre_user_id, ['qty_subastas' => $resta]);
                }
                $data = [
                    'user_id' => $user_id,
                    'subasta_id' => $subasta_id,
                    'is_active' => 1
                ];
                $id = $this->subasta->create_subasta_user($data);
                if ($id) {
                    $this->response(['status' => 200]);
                } else {
                    $this->response(['status' => 404]);
                }
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function cargar_mis_subastas_post()
    {
        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $limite = $this->input->post('limite');
        $limite = 11;
        $comienza = $this->input->post('comienza');
        $infinito = false;
        if ($comienza > 0) {
            $infinito = true;
        }
        $auth = $this->user->is_valid_auth($user_id, $security_token);

        if ($auth) {
            $fecha = strtotime(date("Y-m-d H:i:00", time()));
            $all_subasta = $this->subasta->get_all_by_mis_subastas_with_pagination($limite, $comienza, $user_id);
            $this->load->model("Categoria_model", "categoria");
            $this->load->model('Pais_model', 'pais');
            $subastas = [];
            foreach ($all_subasta as $item) {
                $title = strlen($item->nombre_espa);
                $categoria_object = $this->categoria->get_by_id($item->categoria_id);
                $item->categoria = $categoria_object;
                $ciudad_object = $this->pais->get_by_ciudad_id_object($item->ciudad_id);
                $item->ciudad = $ciudad_object;
                if ($title > 19) {
                    $item->nombre_espa = substr($item->nombre_espa, 0, 16) . "...";
                } else {
                    $item->nombre_espa = $item->nombre_espa;
                }
                if ($item->tipo_subasta == 2) {
                    $item->intervalo = $this->subasta->get_by_intervalo_id_row($item->intervalo_subasta_id);
                    array_push($subastas, $item);
                } else {

                    $subasta_user =  $this->subasta->get_subasta_user($user_id, $item->subasta_id);
                    $puja =  $this->subasta->get_puja_alta($item->subasta_id);

                    if ($subasta_user) {
                        $puja_user = $this->subasta->get_puja_alta_user($item->subasta_id, $user_id);
                    } else {
                        $subasta_user = null;
                        $puja_user = null;
                    }
                    $puja =  $this->subasta->get_puja_alta($item->subasta_id);
                    if ($puja) {
                        $user_win = $this->subasta->get_puja_alta_obj($item->subasta_id);
                        if ($user_win) {
                            $user_win->surname = substr($user_win->surname, 0, 4) . "...";
                        }
                    } else {
                        $user_win = null;
                    }
                    $item->puja_win = $puja;
                    $item->user_win = $user_win;
                    $item->puja_user = $puja_user;
                    $item->subasta_user = $subasta_user;
                    array_push($subastas, $item);
                }
            }
            if ($subastas) {
                $this->response(['status' => 200, 'lista' => $subastas]);
            } else {
                $this->response(['status' => 404, 'infinito' => $infinito]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function ciudades_post()
    {
        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        if ($auth) {
            $this->load->model('Pais_model', 'pais');
            $this->load->model("Categoria_model", "categoria");
            $ciudades = $this->pais->get_by_pais_id_object(4);
            $categorias = $this->categoria->get_all(['is_active' => 1]);
            foreach ($categorias as $item) {
                $item->subcategorias = $this->categoria->get_all_subcat_from_idcat($item->categoria_id);
            }
            if (count($ciudades) > 0) {

                $this->response(['status' => 200, 'lista' => $ciudades, 'categorias' => $categorias]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function generar_pedido_inversa_post()
    {
        $subasta_id = $this->input->post('subasta_id');
        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $this->load->model('Subasta_model', 'subasta');
        $subasta = $this->subasta->get_intervalo_subasta($subasta_id);
        $count = count($subasta);
        $data = [
            'user_id' => $user_id,
            'subasta_id' => $subasta_id,
            'is_active' => 0,
            'intervalo_subasta_id' => $subasta[$count - 1]->intervalo_subasta_id,
            'cliente' => null
        ];
        $cliente = $this->user->get_by_id($user_id);
        $cliente = (object)$cliente;
        $data['cliente'] = json_encode($cliente);
        $id =  $this->subasta->create_subasta_user($data);
        if ($id) {
            $this->load->model("Correo_model", "correo");
            $asunto = "Subasta inversa";
            $motivo = 'Subasta anuncios';
            $mensaje = "<p><img style='width:209px;heigth:44px' src='https://subastanuncios.com/assets/logo_subasta.png'></p>";
            $mensaje .= "<h3>Ir al panel administrativo, venta de subasta inversa por revisar</h3>";
            $this->correo->sent("info@subastanuncios.com", $mensaje, $asunto, $motivo);
            $this->response(['status' => 200]);
        } else {
            $this->response(['status' => 500]);
        }
    }
}
