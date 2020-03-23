<?php

class Subasta  extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Subasta_model', 'subasta');
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

        $all_subasta = $this->subasta->get_all(['is_active' => 1]);


        $this->load->model("Categoria_model", "categoria");
        $this->load->model('Pais_model', 'pais');
        foreach ($all_subasta as $item) {
            $categoria_object = $this->categoria->get_by_id($item->categoria_id);
            $item->categoria = $categoria_object;

            $ciudad_object = $this->pais->get_by_ciudad_id_object($item->ciudad_id);
            $item->ciudad = $ciudad_object;
        }


        $data['all_subasta'] = $all_subasta;
        $this->load_view_admin_g("subasta/index", $data);
    }


    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $this->load->model('Categoria_model', 'categoria');
        $data['all_categoria'] = $this->categoria->get_all();



        $this->load->model('Pais_model', 'pais');
        $data['all_ciudad'] = $this->pais->get_all_ciudad();


        $this->load_view_admin_g('subasta/add', $data);
    }


    public function add()
    {
        //inicio de Sesion, tiene que ser SuperAdmin
        if (!in_array($this->session->userdata('role_id'), [1])) {
            $this->log_out();
            redirect('login');
        }

        //$this->load->model('Categoria_model', 'categoria');

        $user_id = $this->session->userdata('user_id');
        $nombre_espa = $this->input->post('nombre_espa');
        $descrip_espa = $this->input->post('descrip_espa');
        $name_espa = $this->input->post('name_espa'); //nombre categoria
        $is_open = $this->input->post('is_open');
        $ciudad = $this->input->post('ciudad');
        $tipo = $this->input->post('tipo_subasta');
        //directa
        $valor_pago = $this->input->post('valor_pago');
        $valor_inicial = $this->input->post('valor_inicial');
        $fecha_cierre = $this->input->post('fecha_cierre');
        //inversa
        $cantidad_dias = $this->input->post('cantidad_dias');
        $intervalo_dias = $this->input->post('intervalo_dias');
        $valor_maximo = $this->input->post('valor_maximo');
        $valor_minimo = $this->input->post('valor_minimo');
        $porcentaje_dias = $this->input->post('porcentaje_dias');
        $qty_articles = $this->input->post('qty_articles');


        //establecer reglas de validacion
        $this->form_validation->set_rules('nombre_espa', translate('nombre_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("subasta/add_index");
        } else {
            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = save_image_from_post('archivo', './uploads/subasta', time(), 768, 768);
                if ($result[0]) {
                    if ($tipo == 1) {
                        $data_subasta = [
                            'nombre_espa' => $nombre_espa,
                            'descrip_espa' => $descrip_espa,
                            'valor_inicial' => $valor_inicial,
                            'categoria_id' => $name_espa,
                            'photo' => $result[1],
                            'fecha_cierre' => $fecha_cierre,
                            'valor_pago' => $valor_pago,
                            'is_open' => $is_open,
                            'user_id' => $user_id,
                            'ciudad_id' => $ciudad,
                            'is_active' => 1,
                            'tipo_subasta' => $tipo,
                            'cantidad_dias' => null,
                            'intervalo' => null,
                            'porcentaje' => null,
                            'valor_maximo' => null,
                            'valor_minimo' => null
                        ];
                    } else {
                        $fecha = date('Y-m-d H:i:s');
                        $nuevafecha = strtotime('+' . $cantidad_dias . ' day', strtotime($fecha));
                        $nuevafecha = date('Y-m-d H:i:s', $nuevafecha);
                        $data_subasta = [
                            'nombre_espa' => $nombre_espa,
                            'descrip_espa' => $descrip_espa,
                            'valor_inicial' => null,
                            'categoria_id' => $name_espa,
                            'photo' => $result[1],
                            'fecha_cierre' => $nuevafecha,
                            'valor_pago' => null,
                            'is_open' => $is_open,
                            'user_id' => $user_id,
                            'ciudad_id' => $ciudad,
                            'is_active' => 1,
                            'tipo_subasta' => $tipo,
                            'cantidad_dias' => $cantidad_dias,
                            'intervalo' => $intervalo_dias,
                            'porcentaje' => $porcentaje_dias,
                            'valor_maximo' => $valor_maximo,
                            'valor_minimo' => $valor_minimo,
                            'qty_articles' => $qty_articles
                        ];
                    }

                    $id =  $this->subasta->create($data_subasta);
                    if ($id) {
                        $fecha = date('Y-m-d');
                        $nuevafecha = strtotime('+' . $intervalo_dias . ' day', strtotime($fecha));
                        $nuevafecha = date('Y-m-d', $nuevafecha);
                        $this->subasta->create_intervalo(['subasta_id' => $id, 'valor' => $valor_maximo, 'cantidad' => $qty_articles, 'fecha' => $nuevafecha]);
                    }

                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("subasta/index", "location", 301);
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("subasta/add_index", "location", 301);
                }
            } else {
                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("subasta/add_index", "location", 301);
            }
        }
    }


    function update_index($subasta_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $subasta_object = $this->subasta->get_by_id($subasta_id);

        if ($subasta_object) {
            $this->load->model('Categoria_model', 'categoria');
            $this->load->model('Pais_model', 'pais');

            $all_categoria = $this->categoria->get_all();
            $data['all_categoria'] = $all_categoria;

            $all_ciudad = $this->pais->get_all_ciudad();
            $data['all_ciudad'] = $all_ciudad;


            $data['subasta_object'] = $subasta_object;

            $this->load_view_admin_g('subasta/update', $data);
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

        $subasta_id = $this->input->post('subasta_id');
        $subasta_object = $this->subasta->get_by_id($subasta_id);

        $nombre_espa = $this->input->post('nombre_espa');
        $descrip_espa = $this->input->post('descrip_espa');
        $name_espa = $this->input->post('name_espa'); //nombre categoria
        $ciudad = $this->input->post('ciudad');
        $is_open = $this->input->post('is_open');
        $tipo = $this->input->post('tipo_subasta');
        //directa
        $valor_pago = $this->input->post('valor_pago');
        $valor_inicial = $this->input->post('valor_inicial');
        $fecha_cierre = $this->input->post('fecha_cierre');
        //inversa
        $cantidad_dias = $this->input->post('cantidad_dias');
        $intervalo_dias = $this->input->post('intervalo_dias');
        $valor_maximo = $this->input->post('valor_maximo');
        $valor_minimo = $this->input->post('valor_minimo');
        $porcentaje_dias = $this->input->post('porcentaje_dias');
        $qty_articles = $this->input->post('qty_articles');


        //establecer reglas de validacion
        $this->form_validation->set_rules('name_espa', translate('nombre_lang'), 'required');
        //$this->form_validation->set_rules('price', translate('price_lang'), 'required|numeric');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("subasta/update_index/" . $subasta_id);
        } else { //en caso de que todo este bien

            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension || $_FILES['archivo']['error'] == 4) {

                if ($_FILES['archivo']['error'] == 4) {
                    if ($tipo == 1) {
                        $data = [
                            'nombre_espa' => $nombre_espa,
                            'descrip_espa' => $descrip_espa,
                            'valor_inicial' => $valor_inicial,
                            'categoria_id' => $name_espa,
                            'fecha_cierre' => $fecha_cierre,
                            'valor_pago' => $valor_pago,
                            'ciudad_id' => $ciudad,
                            'is_open' => $is_open,
                            'tipo_subasta' => $tipo,
                            'cantidad_dias' => null,
                            'intervalo' => null,
                            'porcentaje' => null,
                            'valor_maximo' => null,
                            'valor_minimo' => null
                        ];
                    } else {
                        $data = [
                            'nombre_espa' => $nombre_espa,
                            'descrip_espa' => $descrip_espa,
                            'valor_inicial' => null,
                            'categoria_id' => $name_espa,
                            'fecha_cierre' => null,
                            'valor_pago' => null,
                            'is_open' => $is_open,
                            'ciudad_id' => $ciudad,
                            'is_active' => 1,
                            'tipo_subasta' => $tipo,
                            'cantidad_dias' => $cantidad_dias,
                            'intervalo' => $intervalo_dias,
                            'porcentaje' => $porcentaje_dias,
                            'valor_maximo' => $valor_maximo,
                            'valor_minimo' => $valor_minimo,
                            'qty_articles' => $qty_articles
                        ];
                    }



                    $this->subasta->update($subasta_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("subasta/index");
                } else {
                    if ($subasta_object) { //modificando la foto

                        $result = save_image_from_post('archivo', './uploads/subasta', time(), 768, 768);
                        if ($result[0]) {
                            if (file_exists($subasta_object->photo))
                                unlink($subasta_object->photo);
                            if ($tipo == 1) {
                                $data = [
                                    'nombre_espa' => $nombre_espa,
                                    'is_open' => $is_open,
                                    'descrip_espa' => $descrip_espa,
                                    'valor_inicial' => $valor_inicial,
                                    'categoria_id' => $name_espa,
                                    'photo' => $result[1],
                                    'fecha_cierre' => $fecha_cierre,
                                    'valor_pago' => $valor_pago,
                                    'ciudad_id' => $ciudad,
                                    'tipo_subasta' => $tipo,

                                ];
                            } else {
                                $data = [
                                    'nombre_espa' => $nombre_espa,
                                    'is_open' => $is_open,
                                    'descrip_espa' => $descrip_espa,
                                    'categoria_id' => $name_espa,
                                    'photo' => $result[1],
                                    'ciudad_id' => $ciudad,
                                    'tipo_subasta' => $tipo,
                                    'cantidad_dias' => $cantidad_dias,
                                    'intervalo' => $intervalo_dias,
                                    'porcentaje' => $porcentaje_dias,
                                    'valor_maximo' => $valor_maximo,
                                    'valor_minimo' => $valor_minimo
                                ];
                            }

                            $this->subasta->update($subasta_id, $data);
                            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                            redirect("subasta/index");
                        } else {
                            $this->response->set_message($result[1], ResponseMessage::ERROR);
                            redirect("subasta/update_index/" . $subasta_id);
                        }
                    } else {
                        show_404();
                    }
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("subasta/update_index/" . $subasta_id);
            }
        }
    }

    public function delete($subasta_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $subasta_object = $this->subasta->get_by_id($subasta_id);

        if ($subasta_object) { //eliminado foto

            $this->subasta->update($subasta_id, ['is_active' => 0]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("subasta/index");
        } else {
            show_404();
        }
    }

    public function change_open($subasta_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $subasta_object = $this->subasta->get_by_id($subasta_id);

        if ($subasta_object) { //eliminado foto
            if ($subasta_object->is_open == 1) {
                $this->subasta->update($subasta_id, ['is_open' => 0]);
            } else if ($subasta_object->is_open == 0) {
                $this->subasta->update($subasta_id, ['is_open' => 1]);
            }

            $this->response->set_message(translate('data_changed_ok'), ResponseMessage::SUCCESS);
            redirect("subasta/index");
        } else {
            show_404();
        }
    }
    //creacion de la vista fotos

    function index_foto($subasta_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $all_fotos = $this->subasta->get_by_subasta_id($subasta_id);

        $data['all_fotos'] = $all_fotos;
        $data['subasta_id'] = $subasta_id;

        $this->load_view_admin_g('subasta/index_foto', $data);
    }


    //crea el registro de las fotos
    public function add_foto()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }
        //FK
        $subasta_id = $this->input->post('subasta_id');
        //en caso de que todo este bien
        $name_file = $_FILES['archivo']['name'];

        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension) {
            $result = save_image_from_post('archivo', './uploads/photo', time(), 768, 768);
            if ($result[0]) {
                $data = [
                    'url_photo' => $result[1],
                    'subasta_id' => $subasta_id
                ];

                $this->subasta->create_foto($data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("subasta/index_foto/" . $subasta_id);
            } else {
                $this->response->set_message($result[1], ResponseMessage::ERROR);
                redirect("subasta/index_foto/" . $subasta_id, "location", 301);
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("subasta/index_foto/" . $subasta_id, "location", 301);
        }
    }

    //llama a la vista que actuliza una foto en especifico

    function update_index_foto($photo_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $foto_object = $this->subasta->get_by_foto_id_object($photo_id);

        if ($foto_object) {
            $data['foto_object'] = $foto_object;
            $this->load_view_admin_g('subasta/foto_update', $data);
        } else {
            show_404();
        }
    }

    //actualiza la imagen de la galeria segun la imagen seleccionada a actualzar

    public function update_foto()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $photo_id = $this->input->post('photo_id');

        $foto_object = $this->subasta->get_by_foto_id_object($photo_id);

        $name_file = $_FILES['archivo']['name'];
        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension || $_FILES['archivo']['error'] == 4) {

            if ($foto_object) {

                $result = save_image_from_post('archivo', './uploads/photo', time(), 768, 768);

                if ($result[0]) {

                    if (file_exists($foto_object->url_photo))

                        unlink($foto_object->url_photo);

                    $data = ['url_photo' => $result[1]];
                    $this->subasta->update_fotos($photo_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("subasta/index_foto/" . $foto_object->subasta_id);
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("subasta/update_index_foto/" . $photo_id);
                }
            } else {
                show_404();
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("subasta/update_index_foto/" . $photo_id);
        }
    }

    //elimina fisicamente una imagen seleccionada en especifico de la galeria

    public function delete_foto($photo_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $foto_object = $this->subasta->get_by_foto_id_object($photo_id);

        if ($foto_object) {
            unlink($foto_object->url_photo);
            $this->subasta->delete_foto($photo_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("subasta/index_foto/" . $foto_object->subasta_id, "location", 301);
        } else {
            show_404();
        }
    }
    function resultados($subasta_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }

        $subasta_object = $this->subasta->get_by_id($subasta_id);

        if ($subasta_object) {

            $this->load->model('Categoria_model', 'categoria');
            $this->load->model('Pais_model', 'pais');
            $this->load->model('Membresia_model', 'membresia');
            $this->load->model('User_model', 'user');
            if ($subasta_object->tipo_subasta == 1) {
                $categoria_object = $this->categoria->get_by_id($subasta_object->categoria_id);
                $ciudad_object = $this->pais->get_by_ciudad_id_object($subasta_object->ciudad_id);
                $galeria = $this->subasta->get_by_subasta_id($subasta_id);
                $puja =  $this->subasta->get_puja_alta($subasta_id);
                $piso = $this->subasta->get_all_subasta_id($subasta_id);
                $array = [];
                foreach ($piso as $item) {
                    $user = $this->user->get_by_id($item->user_id);
                    $user->membresia = $this->membresia->get_by_user_id($user->user_id);
                    $user->ciudad = $this->pais->get_by_ciudad_id_object($user->ciudad_id);
                    array_push($array, $user);
                }

                if ($puja) {
                    $user_win = $this->subasta->get_user_puja_alta($puja->valor);
                    if ($user_win) {
                        $user_win->membresia = $this->membresia->get_by_user_id($user_win->user_id);
                        $user_win->ciudad = $this->pais->get_by_ciudad_id_object($user_win->ciudad_id);
                    }
                } else {
                    $user_win = null;
                }
                $pujas = $this->subasta->get_pujas($subasta_id);
                foreach ($pujas as $item) {
                    $user = $this->user->get_by_id($item->user_id);
                    $user->membresia = $this->membresia->get_by_user_id($user->user_id);
                    $user->ciudad = $this->pais->get_by_ciudad_id_object($user->ciudad_id);
                    $item->user = $user;
                }

                $data['categoria'] = $categoria_object;
                $data['ciudad'] = $ciudad_object;
                $data['galeria'] = $galeria;
                $data['subasta'] = $subasta_object;
                $data['user_win'] = $user_win;
                $data['subasta'] = $subasta_object;
                $data['puja'] = $puja;
                $data['pisos'] = $array;
                $data['pujas'] = $pujas;
                $this->load_view_admin_g('subasta/resultados_directas', $data);
            } else {
                $categoria_object = $this->categoria->get_by_id($subasta_object->categoria_id);
                $ciudad_object = $this->pais->get_by_ciudad_id_object($subasta_object->ciudad_id);
                $galeria = $this->subasta->get_by_subasta_id($subasta_id);
                $intervalos = $this->subasta->get_intevalo_by_id($subasta_id);
                foreach ($intervalos as $item) {
                    $subasta_user = $this->subasta->get_all_subasta_intervalo($item->intervalo_subasta_id);
                    if ($subasta_user) {
                        foreach ($subasta_user as $subasta) {
                            $user = $this->user->get_by_id($subasta->user_id);
                            $user->membresia = $this->membresia->get_by_user_id($user->user_id);
                            $user->ciudad = $this->pais->get_by_ciudad_id_object($user->ciudad_id);
                            $subasta->user = $user;
                        }
                    }
                    $item->user_subasta = $subasta_user;
                }

                $data['intervalos'] = $intervalos;
                $data['categoria'] = $categoria_object;
                $data['ciudad'] = $ciudad_object;
                $data['galeria'] = $galeria;
                $data['subasta'] = $subasta_object;
                $this->load_view_admin_g('subasta/resultados_inversas', $data);
            }
        } else {
            show_404();
        }
    }
}
