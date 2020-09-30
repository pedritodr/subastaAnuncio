<?php
require './vendor/autoload.php';

use Dnetix\Redirection\PlacetoPay;

/**
 * Instanciates the PlacetoPay object providing the login and tranKey, also the url that will be
 * used for the service
 * @return PlacetoPay
 */

class Front extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->library(array('session'));
        // Load the library
        $this->load->library('recaptcha');
        $this->load->library('pagination');
        $this->load->helper("mabuya");

        @session_start();
        $this->session->set_userdata('lang_subasta', 'es');
        $this->load_language();
        $this->init_form_validation();
        ini_set('memory_limit', '512M');
    }

    public function show_404()
    {
        redirect('portada');
        $this->load->model('Empresa_model', 'empresa');
        $data['empresa'] = $this->empresa->get_by_id(1);
        $this->load->view("404", $data);
    }

    public function index()
    {

        $this->load->model('Empresa_model', 'empresa');
        $this->load->model('Cate_anuncio_model', 'cate_anuncio');
        $this->load->model('Categoria_model', 'categoria');
        $this->load->model('Subasta_model', 'subasta');
        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Pais_model', 'pais');


        $data['empresa_object'] = $this->empresa->get_by_id(1);
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
        $data['all_banners'] = $all_banners;


        $all_cate_anuncio = $this->cate_anuncio->get_all();
        foreach ($all_cate_anuncio as $item) {
            $item->count = count($this->anuncio->get_anuncios_by_category($item->cate_anuncio_id));
        }
        $data['all_cate_anuncio'] = $all_cate_anuncio;

        $all_subcate = $this->cate_anuncio->get_all_subcate();

        $data['all_subcate'] = $all_subcate;

        $all_categorias = $this->categoria->get_all(['is_active' => 1]);

        foreach ($all_categorias as $item) {
            $contador_inversa = 0;
            $contador_directa = 0;
            $subastas  = $this->subasta->get_by_categoria_id($item->categoria_id);
            foreach ($subastas as $subasta) {
                $nombre = strlen($subasta->nombre_espa);

                if ($nombre > 54) {
                    $subasta->titulo_corto = substr($subasta->nombre_espa, 0, 54) . "...";
                } else {

                    $subasta->titulo_corto = $subasta->nombre_espa;
                }
                if ($subasta->tipo_subasta == 1) {
                    $contador_directa++;
                    $subasta->intervalo = null;
                } else {
                    $subasta->intervalo = $this->subasta->get_intervalo_subasta($subasta->subasta_id);
                    $contador_inversa++;
                }
            }
            $item->count_inversa = $contador_inversa;
            $item->count_directa = $contador_directa;
            $item->all_subastas = $subastas;
        }

        $data['all_categorias'] = $all_categorias;
        $all_subastas = $this->subasta->get_subastas();

        $data['all_subastas'] = $all_subastas;

        /*  var_dump($all_categorias);
        die();*/
        $this->load_view_front('front/index', $data);
    }

    public function llamar_login()
    {
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
        $data['all_banners'] = $all_banners;

        $this->load_view_front('front/login', $data);
    }

    public function faq()
    {
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
        $data['all_banners'] = $all_banners;
        $this->load_view_front('front/faq', $data);
    }
    public function condiciones()
    {
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
        $data['all_banners'] = $all_banners;
        $this->load_view_front('front/condiciones', $data);
    }
    public function politicas()
    {
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
        $data['all_banners'] = $all_banners;
        $this->load_view_front('front/politicas', $data);
    }
    public function aviso_legal()
    {
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
        $data['all_banners'] = $all_banners;
        $this->load_view_front('front/aviso_legal', $data);
    }
    public function registrar()
    {
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
        $data['all_banners'] = $all_banners;

        $this->load_view_front('front/add_cliente', $data);
    }


    public function anuncio()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login');
        }
        $this->load->model('Cate_anuncio_model', 'cate_anuncio');
        $this->load->model('Pais_model', 'pais');

        $all_cate_anuncio = $this->cate_anuncio->get_all();
        $data['all_cate_anuncio'] = $all_cate_anuncio;

        $all_subcate = $this->cate_anuncio->get_by_Cate_anuncio_id($all_cate_anuncio[0]->cate_anuncio_id);
        $all_pais = $this->pais->get_all();
        $data['all_pais'] = $all_pais;
        $all_ciudad = $this->pais->get_by_pais_id_object($all_pais[0]->pais_id);
        $data['all_ciudad'] = $all_ciudad;
        $data['all_subcate'] = $all_subcate;
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
        $data['all_banners'] = $all_banners;
        $this->load_view_front('front/add_anuncio', $data);
    }
    public function update_anuncio_index($anuncio_id)
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            $this->log_out();
            redirect('login');
        }
        $this->load->model('Cate_anuncio_model', 'cate_anuncio');
        $this->load->model('Pais_model', 'pais');
        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Photo_anuncio_model', 'photo_anuncio');


        $anuncio_object = $this->anuncio->get_by_id($anuncio_id);

        if ($anuncio_object) {
            $ciudad = $this->pais->get_by_city_all($anuncio_object->ciudad_id);
            $categoria = $this->cate_anuncio->get_sub_categoria_by_sub2($anuncio_object->subcate_id);
            $fotos_object = $this->photo_anuncio->get_by_anuncio_id($anuncio_id);
            $data['categoria'] =  $categoria;
            $data['ciudad'] =  $ciudad;
            $data['anuncio_object'] =  $anuncio_object;
            $data['fotos_object'] = $fotos_object;
            $all_cate_anuncio = $this->cate_anuncio->get_all();
            $data['all_cate_anuncio'] = $all_cate_anuncio;

            if ($categoria) {
                $all_subcate = $this->cate_anuncio->get_by_Cate_anuncio_id($categoria->cate_anuncio_id);
            } else {
                $all_subcate = $this->cate_anuncio->get_by_Cate_anuncio_id($all_cate_anuncio[0]->cate_anuncio_id);
            }


            $all_pais = $this->pais->get_all();
            $data['all_pais'] = $all_pais;


            if ($ciudad) {
                $all_ciudad = $this->pais->get_by_pais_id_object($ciudad->pais_id);
            } else {
                $all_ciudad = $this->pais->get_by_pais_id_object($all_pais[0]->pais_id);
            }

            $data['all_ciudad'] = $all_ciudad;

            $data['all_subcate'] = $all_subcate;
            $this->load->model('Banner_model', 'banner');
            $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
            $data['all_banners'] = $all_banners;
            $this->load_view_front('front/update_anuncio', $data);
        } else {
            show_404();
        }
    }

    public function update_anuncio()
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            $this->log_out();
            redirect('login');
        }
        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Pais_model', 'pais');
        $this->load->model('Photo_anuncio_model', 'photo_anuncio');
        $titulo = $this->input->post('titulo');
        $descripcion = $this->input->post('descripcion');
        $precio = $this->input->post('precio');
        $whatsapp = $this->input->post('whatsapp');
        $subcate_id = $this->input->post('subcategoria');
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');
        //  $ciudad = $this->input->post('ciudad');
        $user_id = $this->session->userdata('user_id');
        $direccion = $this->input->post('pac-input');
        $anuncio_id = $this->input->post('anuncio_id');
        $city = $this->input->post('city_main');
        $data = json_decode($_POST['array_fotos']);

        if ($city != null) {
            $city = strtoupper($city);
            $ciudad_object = $this->pais->get_city($city);
            if (!$ciudad_object) {
                $data_ciudad = [
                    'name_ciudad' => $city,
                    'pais_id' => 4,
                ];
                $ciudad_id = $this->pais->create_cuidad($data_ciudad);
            } else {
                $ciudad_id = $ciudad_object->ciudad_id;
            }
        } else {
            $ciudad_id = 4;
        }
        $object = $this->anuncio->get_by_id($anuncio_id);

        //establecer reglas de validacion
        $this->form_validation->set_rules('titulo', translate('titulo_anun_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("perfil/page/");
        } else {
            define('UPLOAD_DIR', './uploads/anuncio/');
            $fotos = [];
            $salva = [];
            $main_photo = "editar";
            if ($data) {
                foreach ($data as $item) {
                    if ($item->foto_anuncio_id == null) {
                        if ($item->name == "image_1") {
                            $img =  $item->imagen;
                            $img = str_replace('data:image/png;base64,', '', $img);
                            $img = str_replace(' ', '+', $img);
                            $data = base64_decode($img);
                            $file = UPLOAD_DIR . uniqid() . '.jpg';
                            $success = file_put_contents($file, $data);
                            $main_photo = $file;
                        } else {
                            $img =  $item->imagen;
                            $img = str_replace('data:image/png;base64,', '', $img);
                            $img = str_replace(' ', '+', $img);
                            $data = base64_decode($img);
                            $file = UPLOAD_DIR . uniqid() . '.jpg';
                            $success = file_put_contents($file, $data);
                            array_push($fotos, $file);
                        }
                    } else {
                        if ($item->name != "image_1") {
                            array_push($salva, $item);
                        }
                    }
                }
            }
            if ($main_photo != "editar") {
                if (file_exists($object->photo)) {
                    unlink($object->photo);
                }

                $datos = [
                    'titulo' => $titulo,
                    'descripcion' => $descripcion,
                    'precio' => $precio,
                    'whatsapp' => $whatsapp,
                    'subcate_id' => $subcate_id,
                    'lat' => $lat,
                    'lng' => $lng,
                    'ciudad_id' => $ciudad_id,
                    'direccion' => $direccion,
                    'photo' => $main_photo
                ];
            } else {
                $datos = [
                    'titulo' => $titulo,
                    'descripcion' => $descripcion,
                    'precio' => $precio,
                    'whatsapp' => $whatsapp,
                    'subcate_id' => $subcate_id,
                    'lat' => $lat,
                    'lng' => $lng,
                    'ciudad_id' => $ciudad_id,
                    'direccion' => $direccion,
                ];
            }

            $id = $this->anuncio->update($anuncio_id, $datos);
            $foto_object = $this->anuncio->get_all_fotos(['anuncio_id' => $anuncio_id]);

            foreach ($foto_object as $foto) {
                $encontro = false;
                if (count($salva) > 0) {
                    foreach ($salva as $item) {
                        if ($item->foto_anuncio_id == $foto->photo_anuncio_id) {
                            $encontro = true;
                        }
                    }
                }

                if (!$encontro) {
                    if (file_exists($foto->photo_anuncio)) {
                        unlink($foto->photo_anuncio);
                    }
                    $this->photo_anuncio->delete($foto->photo_anuncio_id);
                }
            }

            if (count($fotos) > 0) {

                for ($i = 0; $i < count($fotos); $i++) {
                    $img =  $fotos[$i];
                    $this->photo_anuncio->create(['photo_anuncio' => $img, 'anuncio_id' => $anuncio_id]);
                }
            }
            //   die();
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            $this->session->set_userdata('validando', 2);
            redirect("perfil/page/");
        }
    }


    public function get_ciudad()
    { //buscar ciudad


        $this->load->model('Pais_model', 'pais');

        $pais_id = $this->input->post('pais_id');

        $all_ciudades = $this->pais->get_by_pais_id_object($pais_id);

        echo json_encode($all_ciudades);
        exit();
    }
    public function delete_ads()
    {
        $this->load->model('Anuncio_model', 'anuncio');
        $anuncio_id = $this->input->post('anuncio_id');
        $row = $this->anuncio->update($anuncio_id, ['is_delete' => 1]);
        if ($row > 0) {
            echo json_encode(['status' => 200]);
        } else {
            echo json_encode(['status' => 500]);
        }
        exit();
    }
    public function get_subcate() //buscar subcategoria
    {

        $this->load->model('Cate_anuncio_model', 'cate_anuncio');

        $categoria_id = $this->input->post('categoria_id');

        $all_sub_categorias = $this->cate_anuncio->get_by_Cate_anuncio_id($categoria_id);

        echo json_encode($all_sub_categorias);
        exit();
    }

    public function get_subcate_subasta() //buscar subcategoria
    {

        $this->load->model('Cate_anuncio_model', 'cate_anuncio');

        $categoria_id = $this->input->post('categoria_id');
        $all_sub_categorias = $this->cate_anuncio->get_by_Cate_subasta_id($categoria_id);

        echo json_encode($all_sub_categorias);
        exit();
    }

    public function Lista_anuncio()
    {

        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Cate_anuncio_model', 'cate_anuncio');
        $this->load->model('Pais_model', 'pais');
        $user_id = $this->session->userdata('user_id');


        $all_anuncios = $this->anuncio->get_all(['user_id' => $user_id]);


        foreach ($all_anuncios as $item) {


            $subcate_object = $this->cate_anuncio->get_by_subcate_id_object($item->subcate_id);

            $item->subcate =  $subcate_object;

            $all_ciudad = $this->pais->get_by_ciudad_id_object($item->ciudad_id);

            $item->ciudad = $all_ciudad;
        }



        $data['all_anuncios'] = $all_anuncios;

        $this->load_view_front('front/listado_anuncios', $data);
    }

    public function detalle_anuncio($anuncio_id)
    {

        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Photo_anuncio_model', 'photo_anuncio');
        $this->load->model('Cate_anuncio_model', 'cate_anuncio');
        $this->load->model('Pais_model', 'pais');
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
        $data['all_banners'] = $all_banners;


        $all_anuncios = $this->anuncio->get_all_anuncios_id($anuncio_id);
        $relacionados = $this->anuncio->get_relacionados($all_anuncios->cate_anuncio_id, $anuncio_id);
        foreach ($relacionados as $item) {
            $long = strlen($item->descripcion);

            if ($long > 150) {
                $item->corta = substr($item->descripcion, 0, 150) . "...";
            } else {

                $item->corta = $item->descripcion;
            }
            $titulo = strlen($item->titulo);

            if ($titulo > 54) {
                $item->titulo_corto = substr($item->titulo, 0, 54) . "...";
            } else {

                $item->titulo_corto = $item->titulo;
            }
        }
        $fotos_object = $this->photo_anuncio->get_by_anuncio_id($anuncio_id);

        $data['relacionados'] =  $relacionados;
        $data['all_anuncios'] =  $all_anuncios;
        $data['fotos_object'] = $fotos_object;
        $recientes = $this->anuncio->get_all_anuncios_recientes();
        foreach ($recientes as $item) {
            $long = strlen($item->titulo);

            if ($long > 22) {
                $item->titulo_corto = substr($item->titulo, 0, 22) . "...";
            } else {

                $item->titulo_corto = $item->titulo;
            }
        }
        $data['recientes'] = $recientes;
        $destacados = $this->anuncio->get_all_anuncios_destacados();
        foreach ($destacados as $item) {
            $long = strlen($item->titulo);

            if ($long > 20) {
                $item->titulo_corto = substr($item->titulo, 0, 20) . "...";
            } else {

                $item->titulo_corto = $item->titulo;
            }
        }
        $data['destacados'] = $destacados;
        $this->load_view_front('front/detalle_anuncio', $data);
    }

    public function detalle_subasta()
    {

        $this->load->model('Subasta_model', 'subasta');
        $this->load->model('Categoria_model', 'categoria');
        $subasta_id = $this->input->post('id');
        $all_detalle = $this->subasta->get_by_id($subasta_id);
        $user_id = $this->session->userdata('user_id');
        $categoria_id = $this->input->post('id');

        $all_categoria = $this->categoria->get_by_id($categoria_id);

        $foto_object = $this->subasta->get_by_subasta_id($subasta_id);
        if ($user_id) {
            $subasta_user =  $this->subasta->get_subasta_user($user_id, $subasta_id);
            if ($subasta_user) {
                $puja_user = $this->subasta->get_puja_alta_user($subasta_id, $user_id);
            } else {
                $subasta_user = null;
                $puja_user = null;
            }
        } else {
            $subasta_user = null;
            $puja_user = null;
        }

        $puja =  $this->subasta->get_puja_alta($subasta_id);
        if ($puja) {
            // $user_win = $this->subasta->get_user_puja_alta($puja->valor);
            $user_win = $this->subasta->get_puja_alta_obj($subasta_id);
        } else {
            $user_win = null;
        }

        $data['user_win'] = $user_win;
        $data['subasta_user'] = $subasta_user;
        $data['puja'] = $puja;
        $data['all_detalle'] = $all_detalle;
        $data['foto_object'] = $foto_object;
        $data['all_categoria'] = $all_categoria;
        $data['puja_user'] = $puja_user;
        echo json_encode($data);
        exit();
    }
    public function buscar_fotos()
    {

        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Photo_anuncio_model', 'photo_anuncio');
        $id = $this->input->post('id');
        $fotos_object = $this->photo_anuncio->get_by_anuncio_id($id);

        echo json_encode($fotos_object);
        exit();
    }
    public function delete_fotos()
    {

        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Photo_anuncio_model', 'photo_anuncio');
        $id = $this->input->post('id');
        $objeto = $this->photo_anuncio->get_by_id($id);
        $fotos_object = $this->photo_anuncio->get_by_anuncio_id($objeto->anuncio_id);
        unlink($fotos_object->photo_anuncio);
        $this->photo_anuncio->delete($id);

        echo json_encode($fotos_object);
        exit();
    }
    public function photo_anuncio()
    {

        $this->load->model('Photo_anuncio_model', 'photo_anuncio');

        $anuncio_id = $this->input->post('anuncio_id');


        $name_file = $_FILES['archivo']['name'];

        $separado = explode('.', $name_file);
        $ext = end($separado); // me quedo con la extension
        $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
        $allow_extension = in_array($ext, $allow_extension_array);
        if ($allow_extension) {
            $result = save_image_from_post('archivo', './uploads/anuncio', time(), 750, 750);
            if ($result[0]) {
                $data = [
                    'photo_anuncio' => $result[1],
                    'anuncio_id' => $anuncio_id
                ];


                $this->photo_anuncio->create($data);

                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("front/detalle_anuncio/" . $anuncio_id);
            } else {
                $this->response->set_message($result[1], ResponseMessage::ERROR);
                redirect("perfil/page/");
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            $this->session->set_userdata('validando', 2);
            redirect("perfil/page/");
        }
    }

    public function add_cliente()
    {
        require(APPPATH . "libraries/validar_cedula.php");

        $name = $this->input->post('name');
        $apellido = $this->input->post('surname');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $phone = $this->input->post('phone');
        $repeat_password = $this->input->post('repeat_password');
        $tipo_documento = $this->input->post('tipo_documento');
        $nro_documento = $this->input->post('nro_documento');

        if ($tipo_documento == 1) {
            // Crear nuevo objecto
            $validador = new validar_cedula();

            // validar CI
            if ($validador->validarCedula($nro_documento)) {
                //valida
            } else {
                $this->response->set_message("El cédula introducida no es correcta.", ResponseMessage::SUCCESS);
                redirect("registrarse");
            }
        }

        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('primer_nombre_lang'), 'required');
        $this->form_validation->set_rules('surname', translate('primer_apellido_lang'), 'required');
        $this->form_validation->set_rules('email', translate('email_lang'), 'required|is_unique[user.email]');
        if ($password !=  $repeat_password) {
            $this->response->set_message("El campo contraseña no coinciden con el repetir contraseña", ResponseMessage::SUCCESS);
            redirect("registrarse");
        }

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("registrarse");
        } else { //en caso de que todo este bien
            $data_user = [
                'name' => $name,
                'email' => $email,
                'password' => md5($password),
                'phone' => $phone,
                'role_id' => 2,
                'status' => 0,
                'is_active' => 0,
                'surname' => $apellido,
                'cedula' => $nro_documento,
                'tipo_documento' => $tipo_documento
            ];

            $user_id =  $this->user->create($data_user);
            $fecha = date("Y-m-d H:i:s");
            $fecha_vencimiento = strtotime('+5 minute', strtotime($fecha));
            $fecha_vencimiento = date("Y-m-d H:i:s", $fecha_vencimiento);

            $codigo_seguridad = '';
            $caracteres = '0123456789';

            for ($i = 0; $i < 4; $i++) {
                $codigo_seguridad .= $caracteres[rand(0, strlen($caracteres) - 1)];
            }

            $this->user->update($user_id, ['codigo_seguridad' => $codigo_seguridad, 'fecha_vencimiento_codigo' => $fecha_vencimiento]);

            $this->load->model("Correo_model", "correo");
            $asunto = "Validación de usuario";
            $motivo = 'Validación de usuario Subasta anuncios';
            $mensaje = "<p><img style='width:209px;heigth:44px' src='https://subastanuncios.com/assets/logo_subasta.png'></p>";
            $mensaje .= "Hola <br>Nos complace darte la bienvenida a SUBASTANUNCIOS.COM <br>";
            $mensaje .= "Tu usuario (" . $email . ") sea creado satisfactoriamente. Para completar tu registro de manera efectiva debes ingresar el siguiente código de verificación en tu perfil dentro de la Web o cualquiera de las aplicaciones móviles. Tu Código de verificación es:<br>";
            $mensaje .= "" . $codigo_seguridad . "<br>";
            $mensaje .= "Si necesitas contactar con nosotros puedes hacerlo a través del email comercial@suabastanuncios.com <br>";
            $mensaje .= "Gracias por sumarte a nuestra plataforma.<br>";
            $mensaje .= "Saludos,<br>";
            $mensaje .= "El equipo de SUBASTANUNCIOS";
            $this->correo->sent($email, $mensaje, $asunto, $motivo);
            //   $session_data = object_to_array($user);
            //  $this->session->set_userdata($session_data);
            $this->response->set_message('Solo te queda un paso para completar tu registro', ResponseMessage::SUCCESS);
            // $this->session->set_userdata('validando', 1);
            redirect("activacion");
        }
    }
    public function activacion_user()
    {
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
        $data_object['all_banners'] = $all_banners;

        $this->load_view_front('front/activacion_user', $data_object);
    }
    public function generar_codigo()
    {
        $email = $this->input->post('email');
        $user = $this->user->get_user_by_email($email);
        if ($user) {
            $fecha = date("Y-m-d H:i:s");
            $fecha_vencimiento = strtotime('+5 minute', strtotime($fecha));
            $fecha_vencimiento = date("Y-m-d H:i:s", $fecha_vencimiento);

            $codigo_seguridad = '';
            $caracteres = '0123456789';

            for ($i = 0; $i < 4; $i++) {
                $codigo_seguridad .= $caracteres[rand(0, strlen($caracteres) - 1)];
            }

            $this->user->update($user->user_id, [
                'codigo_seguridad' => $codigo_seguridad,
                'fecha_vencimiento_codigo' => $fecha_vencimiento
            ]);
            $this->load->model("Correo_model", "correo");
            $asunto = "Validación de usuario";
            $motivo = 'Validación de usuario Subasta anuncios';
            $mensaje = "<p><img style='width:209px;heigth:44px' src='https://subastanuncios.com/assets/logo_subasta.png'></p>";
            $mensaje .= "Hola <br>Nos complace darte la bienvenida a SUBASTANUNCIOS.COM <br>";
            $mensaje .= "Tu usuario (" . $email . ") sea creado satisfactoriamente. Para completar tu registro de manera efectiva debes ingresar el siguiente código de verificación en tu perfil dentro de la Web o cualquiera de las aplicaciones móviles. Tu Código de verificación es:<br>";
            $mensaje .= "" . $codigo_seguridad . "<br>";
            $mensaje .= "Si necesitas contactar con nosotros puedes hacerlo a través del email comercial@suabastanuncios.com <br>";
            $mensaje .= "Gracias por sumarte a nuestra plataforma.<br>";
            $mensaje .= "Saludos,<br>";
            $mensaje .= "El equipo de SUBASTANUNCIOS";
            $this->correo->sent($email, $mensaje, $asunto, $motivo);
            //   $session_data = object_to_array($user);
            //  $this->session->set_userdata($session_data);
            $this->response->set_message('El código de verificación ha sido generado correctamente', ResponseMessage::SUCCESS);
            // $this->session->set_userdata('validando', 1);
            redirect("activacion");
        } else {
            $this->response->set_message("El email esta incorrecto.", ResponseMessage::ERROR);
            redirect("activacion");
        }
    }
    public function activacion_final()
    {
        $email = $this->input->post('email_valido');
        $codigo = $this->input->post('codigo');
        $user_object = $this->user->get_user_by_email($email);
        if ($user_object) {
            $now = date("Y-m-d H:i:s");
            if ($now > $user_object->fecha_vencimiento_codigo) {
                $this->response->set_message("El código de verificación ya caducó. Por favor genere otró código.", ResponseMessage::ERROR);
                redirect("activacion");
            } else {
                if ($codigo == $user_object->codigo_seguridad) {
                    $this->user->update($user_object->user_id, ['is_active' => 1, 'status' => 1]);
                    $session_data = object_to_array($user_object);
                    $this->session->set_userdata($session_data);
                    $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
                    $this->session->set_userdata('validando', 1);
                    $this->session->set_userdata('login', "ok");
                    redirect("portada");
                } else {
                    $this->response->set_message("El código de verificación no coincide.", ResponseMessage::ERROR);
                    redirect("activacion");
                }
            }
        } else {
            $this->response->set_message("El email esta incorrecto.", ResponseMessage::ERROR);
            redirect("activacion");
        }
    }
    public function update_cliente()
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            $this->log_out();
            redirect('login');
        }
        require(APPPATH . "libraries/validar_cedula.php");
        $this->load->model('User_model', 'user');
        $name = $this->input->post('name');
        $surname = $this->input->post('surname');
        $phone = $this->input->post('phone');
        $ciudad = $this->input->post('ciudad');
        $direccion = $this->input->post('direccion');
        $tipo_documento = $this->input->post('tipo_documento');
        $nro_documento = $this->input->post('nro_documento');

        if ($tipo_documento == 1) {
            // Crear nuevo objecto
            $validador = new validar_cedula();
            // validar CI
            if (!$validador->validarCedula($nro_documento)) {
                $this->response->set_message("El cédula introducida no es correcta.", ResponseMessage::SUCCESS);
                redirect("perfil/page/");
            }
        }

        $user_id = $this->session->userdata('user_id');
        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('primer_nombre_lang'), 'required');
        $this->form_validation->set_rules('surname', translate('primer_apellido_lang'), 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("perfil/page/");
        } else { //en caso de que todo este bien

            $name_file = $_FILES['archivo']['name'];

            if ($name_file != "") {

                $separado = explode('.', $name_file);
                $ext = end($separado); // me quedo con la extension
                $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
                $allow_extension = in_array($ext, $allow_extension_array);
                if ($allow_extension) {
                    $result = save_image_from_post('archivo', './uploads/Cliente', time(), 400, 400);
                    if ($result[0]) {
                        $data = [
                            'name' => $name,
                            'ciudad_id' => $ciudad,
                            'direccion' => $direccion,
                            'phone' => $phone,
                            'photo' => $result[1],
                            'surname' => $surname,
                            'cedula' => $nro_documento,
                            'tipo_documento' => $tipo_documento

                        ];
                        $this->user->update($user_id, $data);
                        $user = $this->user->get_by_id($user_id);
                        $session_data = object_to_array($user);
                        $this->session->set_userdata($session_data);
                        $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
                        $this->session->set_userdata('validando', 1);
                        redirect("perfil/page/");
                    } else {
                        $this->response->set_message($result[1], ResponseMessage::ERROR);
                        redirect("perfil/page", "location", 301);
                    }
                } else {

                    $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                    redirect("perfil/page", "location", 301);
                }
            } else {

                $data_user = [
                    'name' => $name,
                    'ciudad_id' => $ciudad,
                    'direccion' => $direccion,
                    'phone' => $phone,
                    'surname' => $surname,
                    'cedula' => $nro_documento,
                    'tipo_documento' => $tipo_documento

                ];
                $this->user->update($user_id, $data_user);
                $user = $this->user->get_by_id($user_id);
                $session_data = object_to_array($user);
                $this->session->set_userdata($session_data);
                $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
                $this->session->set_userdata('validando', 1);
                redirect("perfil/page/");
            }
        }
    }

    public function add_anuncio()
    {

        if (!in_array($this->session->userdata('role_id'), [2])) {
            $this->log_out();
            redirect('login');
        }
        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Membresia_model', 'membresia');
        $this->load->model('Pais_model', 'pais');
        $titulo = $this->input->post('titulo');
        $descripcion = $this->input->post('descripcion');
        $precio = $this->input->post('precio');
        $photo = $this->input->post('photo');
        $whatsapp = $this->input->post('whatsapp');
        $subcate_id = $this->input->post('subcategoria');
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');
        $user_id = $this->session->userdata('user_id');
        $email = $this->session->userdata('email');
        $direccion = $this->input->post('pac-input');
        $city = $this->input->post('city_main');
        $data = json_decode($_POST['array_fotos']);
        if ($city != null) {
            $city = strtoupper($city);
            $ciudad_object = $this->pais->get_city($city);
            if (!$ciudad_object) {
                $data_ciudad = [
                    'name_ciudad' => $city,
                    'pais_id' => 4,

                ];
                $ciudad_id = $this->pais->create_cuidad($data_ciudad);
            } else {
                $ciudad_id = $ciudad_object->ciudad_id;
            }
        } else {
            $ciudad_id = 4;
        }
        $membresia = $this->membresia->get_by_user_id($user_id);
        $fecha = date('Y-m-d');
        $fecha_fin = strtotime('+30 day', strtotime($fecha));
        $fecha_fin = date('Y-m-d', $fecha_fin);
        //establecer reglas de validacion
        $this->form_validation->set_rules('titulo', translate('titulo_anun_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("perfil/page/");
        } else {
            $this->load->model('Photo_anuncio_model', 'photo_anuncio');

            $fotos = [];
            foreach ($data as $item) {
                $img =  $item->imagen;
                $img = str_replace('data:image/png;base64,', '', $img);

                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);

                $file = UPLOAD_DIR . uniqid() . '.jpg';
                // $image = uniqid() . '.jpg';

                $success = file_put_contents($file, $data);
                array_push($fotos, $file);
            }
            $data = [
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'precio' => $precio,
                'photo' => $fotos[0],
                'whatsapp' => $whatsapp,
                'subcate_id' => $subcate_id,
                'is_active' => 1,
                'lat' => $lat,
                'lng' => $lng,
                'ciudad_id' => $ciudad_id,
                'user_id' => $user_id,
                'direccion' => $direccion,
                'fecha' =>  date("Y-m-d"),
                'destacado' => 0,
                'fecha_vencimiento' => $fecha_fin
            ];
            if ($membresia) {
                $id =  $this->anuncio->create($data);
                if ($id) {
                    if ((int) $membresia->anuncios_publi > 0) {

                        $qty_anuncios = (int) $membresia->anuncios_publi - 1;
                        $this->membresia->update_membresia_user($membresia->membre_user_id, ['anuncios_publi' => $qty_anuncios]);
                        $this->anuncio->update($id, ['destacado' => 1]);
                    }
                    if (count($fotos) > 1) {
                        for ($i = 1; $i < count($fotos); $i++) {
                            $img =  $fotos[$i];
                            $this->photo_anuncio->create(['photo_anuncio' => $img, 'anuncio_id' => $id]);
                        }
                    }
                    $obj_anuncio = $this->anuncio->get_by_id($id);
                    $this->load->model("Correo_model", "correo");
                    $asunto = "Anuncio creado";
                    $motivo = 'Anuncio creado Subasta anuncios';
                    $mensaje = "<p><img style='width:209px;heigth:44px' src='https://subastanuncios.com/assets/logo_subasta.png'></p>";
                    $mensaje .= "<h3> “Nuevo anuncio”</h3>";
                    $mensaje .= "Bien hecho. <br>Has creado un nuevo anuncio dentro de nuestra plataforma. Ahora todos nuestros visitantes podrán visualizarlo y ponerse en contacto contigo. Los datos referenciales de tu anuncio son los siguientes:<br>";
                    $mensaje .= "<strong>Título: </strong>" . $obj_anuncio->titulo . "<br>";
                    $mensaje .= "<strong>Descripción: </strong>" . $obj_anuncio->descripcion . "<br>";
                    $mensaje .= "<strong>Precio: </strong>" . number_format($obj_anuncio->precio, 2) . "<br>";
                    $mensaje .= "<strong>Dirección: </strong>" . $obj_anuncio->direccion . "<br>";
                    $mensaje .= "<strong>whatsapp: </strong>" . $obj_anuncio->whatsapp . "<br>";
                    $mensaje .= "Recuerda que las personas interesadas se pondrán en contacto contigo mediante el número telefónico que especificaste en el anuncio. Te deseemos mucha suerte.<br>";
                    $mensaje .= "Si necesitas contactar con nosotros puedes hacerlo a través del email comercial@suabastanuncios.com <br>";
                    $mensaje .= "Gracias por sumarte a nuestra plataforma<br>";
                    $mensaje .= "Saludos,<br>";
                    $mensaje .= "El equipo de SUBASTANUNCIOS";
                    $this->correo->sent($email, $mensaje, $asunto, $motivo);
                }
            } else {
                $id = $this->anuncio->create($data);
                if ($id) {
                    if (count($fotos) > 1) {
                        for ($i = 1; $i < count($fotos); $i++) {
                            $img =  $fotos[$i];
                            $this->photo_anuncio->create(['photo_anuncio' => $img, 'anuncio_id' => $id]);
                        }
                    }
                    $obj_anuncio = $this->anuncio->get_by_id($id);
                    $this->load->model("Correo_model", "correo");
                    $asunto = "Anuncio creado";
                    $motivo = 'Anuncio creado Subasta anuncios';
                    $mensaje = "<p><img style='width:209px;heigth:44px' src='https://subastanuncios.com/assets/logo_subasta.png'></p>";
                    $mensaje .= "<h3> “Nuevo anuncio”</h3>";
                    $mensaje .= "Bien hecho. <br>Has creado un nuevo anuncio dentro de nuestra plataforma. Ahora todos nuestros visitantes podrán visualizarlo y ponerse en contacto contigo. Los datos referenciales de tu anuncio son los siguientes:<br>";
                    $mensaje .= "<strong>Título: </strong>" . $obj_anuncio->titulo . "<br>";
                    $mensaje .= "<strong>Descripción: </strong>" . $obj_anuncio->descripcion . "<br>";
                    $mensaje .= "<strong>Precio: </strong>" . number_format($obj_anuncio->precio, 2) . "<br>";
                    $mensaje .= "<strong>Dirección: </strong>" . $obj_anuncio->direccion . "<br>";
                    $mensaje .= "<strong>whatsapp: </strong>" . $obj_anuncio->whatsapp . "<br>";
                    $mensaje .= "Recuerda que las personas interesadas se pondrán en contacto contigo mediante el número telefónico que especificaste en el anuncio. Te deseemos mucha suerte.<br>";
                    $mensaje .= "Si necesitas contactar con nosotros puedes hacerlo a través del email comercial@suabastanuncios.com <br>";
                    $mensaje .= "Gracias por sumarte a nuestra plataforma<br>";
                    $mensaje .= "Saludos,<br>";
                    $mensaje .= "El equipo de SUBASTANUNCIOS";
                    $this->correo->sent($email, $mensaje, $asunto, $motivo);
                }
            }

            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            $this->session->set_userdata('validando', 2);
            redirect("perfil/page");
        }
    }
    public function destacar_anuncio()
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            $this->log_out();
            redirect('login');
        }
        $this->load->model('Anuncio_model', 'anuncio');
        $anuncio_id = $this->input->post('anuncio_id_destacar');
        $fecha = date('Y-m-d');
        $fecha_fin = strtotime('+30 day', strtotime($fecha));
        $this->anuncio->update($anuncio_id, ['destacado' => 1, 'fecha_vencimiento' => $fecha_fin, 'fecha' => $fecha]);
        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
        $this->session->set_userdata('validando', 2);
        redirect("perfil/page");
    }
    public function contacto()
    {
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
        $data_object['all_banners'] = $all_banners;

        $this->load_view_front('front/contact', $data_object);
    }
    public function buscar_subasta_directa()
    {
        header('Cache-Control: no cache');
        $this->session->set_userdata('page', 'buscar_subasta');
        $this->load->model('Subasta_model', 'subasta');
        $this->load->model('Categoria_model', 'category');
        $this->load->model('Banner_model', 'banner');
        $this->load->model('Pais_model', 'pais');
        $all_banners = $this->banner->get_all(['menu_id' => 2]); //todos los banners
        $data['all_banners'] = $all_banners;
        $categories = $this->category->get_all();
        $data['categories'] = $categories;
        $category = $this->input->post('category_subasta');

        $subasta_palabra = $this->input->post('subasta_palabra');
        $ciudad_id = $this->input->post('subasta_ciudad_id');
        $tipo_subasta = $this->input->post('tipo_subasta');
        $tipo_subasta_2 = $this->input->post('tipo_subasta_2');
        $subcat = $this->category->get_all_subasta_subcat();
        $data['subcat'] = $subcat;
        if ($tipo_subasta != NULL) {
            $tipo = $tipo_subasta;
        }
        if ($tipo_subasta_2 != NULL) {
            $tipo = $tipo_subasta_2;
        }
        if ($ciudad_id != NULL) {
            if ($ciudad_id == 0) {
                $this->session->set_userdata('session_ciudad_subasta', NULL);
            } else {
                $this->session->set_userdata('session_ciudad_subasta', $ciudad_id);
            }
        } else {
            if ($this->session->userdata('session_ciudad_subasta')) {
                $ciudad_id = $this->session->userdata('session_ciudad_subasta');
            } else {
                $ciudad_id = 0;
            }
        }

        if ($category != NULL) {
            if ($category == 0) {
                $this->session->set_userdata('session_categoria_subasta', NULL);
            } else {
                $this->session->set_userdata('session_categoria_subasta', $category);
            }
        } else {
            if ($this->session->userdata('session_categoria_subasta')) {
                $category = $this->session->userdata('session_categoria_subasta');
            } else {
                $category = 0;
            }
        }


        $contador = count($this->subasta->get_search_all($category, $subasta_palabra, $tipo, $ciudad_id));

        /* URL a la que se desea agregar la paginación*/
        $config['base_url'] = site_url('search_subastas/page/');

        /*Obtiene el total de registros a paginar */

        $config['total_rows'] = $contador;
        $user_id = $this->session->userdata('user_id');

        /*Obtiene el numero de registros a mostrar por pagina */
        $config['per_page'] = '5';
        $config['uri_segment'] = 3;
        /*Se personaliza la paginación para que se adapte a bootstrap*/

        $config['cur_tag_open'] = '<li class="active"><a href="#">';

        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';

        $config['num_tag_close'] = '</li>';

        $config['last_link'] = FALSE;

        $config['first_link'] = FALSE;

        $config['next_link'] = '&raquo;';

        $config['next_tag_open'] = '<li>';

        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';

        $config['prev_tag_open'] = '<li>';

        $config['prev_tag_close'] = '</li>';


        /* Se inicializa la paginacion*/

        $this->pagination->initialize($config);
        $page = $this->uri->segment(3);

        $offset = !$page ? 0 : $page;
        //      $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $all_subastas = $this->subasta->get_all_by_subastas_with_pagination_search($config['per_page'], $offset, $category, $subasta_palabra, $tipo, $ciudad_id);

        $cat_id = "";
        $subcat_id = "";
        if ($tipo == 1) {
            foreach ($all_subastas as $item) {

                $cat_id = $item->categoria_id;
                $subcat_id = $item->subcat_id;

                $long = strlen($item->descrip_espa);

                if ($long > 185) {
                    $item->corta = substr($item->descrip_espa, 0, 185) . "...";
                } else {

                    $item->corta = $item->descrip_espa;
                }
                $nombre = strlen($item->nombre_espa);

                if ($nombre > 100) {
                    $item->corto = substr($item->nombre_espa, 0, 100) . "...";
                } else {

                    $item->corto = $item->nombre_espa;
                }

                $item->contador_fotos = count($this->subasta->get_by_subasta_id($item->subasta_id));

                $item->subasta_user =  $this->subasta->get_subasta_user($user_id, $item->subasta_id);

                $puja =  $this->subasta->get_puja_alta($item->subasta_id);
                $item->puja = $puja;
                if ($puja) {
                    $user_win = $this->subasta->get_user_puja_alta($puja->valor);
                } else {
                    $user_win = null;
                }
                if ($user_id) {
                    $subasta_user =  $this->subasta->get_subasta_user($user_id, $item->subasta_id);
                    $puja_user = $this->subasta->get_puja_alta_user($item->subasta_id, $user_id);
                } else {
                    $subasta_user = null;
                    $puja_user = null;
                }
                $item->subasta_user = $subasta_user;
                $item->puja_user = $puja_user;
                $item->user_win = $user_win;
            }
        } else {
            foreach ($all_subastas as $item) {
                $cat_id = $item->categoria_id;
                $subcat_id = $item->subcat_id;
                $long = strlen($item->descrip_espa);

                if ($long > 185) {
                    $item->corta = substr($item->descrip_espa, 0, 185) . "...";
                } else {

                    $item->corta = $item->descrip_espa;
                }
                $nombre = strlen($item->nombre_espa);
                if ($nombre > 100) {
                    $item->corto = substr($item->nombre_espa, 0, 100) . "...";
                } else {

                    $item->corto = $item->nombre_espa;
                }
                $item->intervalo = $this->subasta->get_intervalo_subasta($item->subasta_id);
                $item->contador_fotos = count($this->subasta->get_by_subasta_id($item->subasta_id));

                $item->subasta_user =  $this->subasta->get_subasta_user($user_id, $item->subasta_id);

                $item->puja =  $this->subasta->get_puja_alta($item->subasta_id);
            }
        }
        $data["cat_id"] = $cat_id;
        $data["subcat_id"] = $subcat_id;

        $data['all_subastas'] = $all_subastas;
        $data['resultados'] = $contador;
        $all_ciudad = $this->pais->get_by_pais_id_object(4);
        $data['all_ciudad'] = $all_ciudad;
        if ($offset == 0) {
            if ($contador == 0) {
                $data['inicio'] = 0;
                $data['fin'] = 0;
            } else {
                $data['inicio'] = 1;
                if ($contador >= 5) {
                    $data['fin'] =  5;
                } else {
                    $data['fin'] = $contador;
                }
            }
        } else {
            $data['inicio'] = $offset + 1;
            $intervalo = 5 + $offset;
            if ($intervalo > $contador) {
                $data['fin'] = $contador;
            } else {
                $data['fin'] = $intervalo;
            }
        }
        header('Cache-Control: no cache');
        $data['tipo'] = $tipo;
        $this->load_view_front('front/subastas', $data);
    }
    public function buscar_subasta_inversa()
    {
        header('Cache-Control: no cache');
        $this->session->set_userdata('page', 'buscar_subasta');
        $this->load->model('Subasta_model', 'subasta');
        $this->load->model('Categoria_model', 'category');
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 2]); //todos los banners
        $data['all_banners'] = $all_banners;
        $categories = $this->category->get_all();
        $data['categories'] = $categories;

        $category = $this->input->post('category');
        $subasta_palabra = $this->input->post('subasta_palabra');

        if ($category == "" && $subasta_palabra == "") {
            $session_categoria = $this->session->userdata('session_categoria');
            if ($session_categoria) {
                $category = $session_categoria;
            }
            $session_palabra = $this->session->userdata('session_palabra');
            if ($session_palabra) {
                $subasta_palabra = $session_palabra;
            }
        }


        $ok = null;
        if ($category != '' && $subasta_palabra != '') {
            $this->session->set_userdata('session_categoria', $category);
            $this->session->set_userdata('session_palabra', $subasta_palabra);
            $contador = count($this->subasta->get_search_all($category, $subasta_palabra, 2));
            $ok = 1;
        } elseif ($category != '' && $subasta_palabra == '') {
            $this->session->set_userdata('session_categoria', $category);
            $contador = count($this->subasta->get_subastas_category($category, 2));
            $ok = 2;
        } else if ($category == '' && $subasta_palabra != '') {
            $this->session->set_userdata('session_palabra', $subasta_palabra);
            $contador = count($this->subasta->get_subastas_palabra($subasta_palabra, 2));
            $ok = 3;
        }

        /* URL a la que se desea agregar la paginación*/
        $config['base_url'] = site_url('front/subasta/');

        /*Obtiene el total de registros a paginar */

        $config['total_rows'] = $contador;
        $user_id = $this->session->userdata('user_id');

        /*Obtiene el numero de registros a mostrar por pagina */
        $config['per_page'] = '5';
        $config['uri_segment'] = 3;
        /*Se personaliza la paginación para que se adapte a bootstrap*/

        $config['cur_tag_open'] = '<li class="active"><a href="#">';

        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';

        $config['num_tag_close'] = '</li>';

        $config['last_link'] = FALSE;

        $config['first_link'] = FALSE;

        $config['next_link'] = '&raquo;';

        $config['next_tag_open'] = '<li>';

        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';

        $config['prev_tag_open'] = '<li>';

        $config['prev_tag_close'] = '</li>';


        /* Se inicializa la paginacion*/

        $this->pagination->initialize($config);
        $page = $this->uri->segment(3);

        $offset = !$page ? 0 : $page;
        //      $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        if ($ok == 1) {
            $all_subastas = $this->subasta->get_all_by_subastas_with_pagination_search($config['per_page'], $offset, $category, $subasta_palabra, 2);
        } else if ($ok == 2) {
            $all_subastas = $this->subasta->get_all_by_subastas_with_pagination_categoria($config['per_page'], $offset, $category, 2);
        } else if ($ok == 3) {
            $all_subastas = $this->subasta->get_all_by_subastas_with_pagination_palabra($config['per_page'], $offset, $subasta_palabra, 2);
        }
        foreach ($all_subastas as $item) {
            $long = strlen($item->descrip_espa);

            if ($long > 185) {
                $item->corta = substr($item->descrip_espa, 0, 185) . "...";
            } else {

                $item->corta = $item->descrip_espa;
            }
            $nombre = strlen($item->nombre_espa);
            if ($nombre > 100) {
                $item->corto = substr($item->nombre_espa, 0, 100) . "...";
            } else {

                $item->corto = $item->nombre_espa;
            }
            $item->intervalo = $this->subasta->get_intervalo_subasta($item->subasta_id);
            $item->contador_fotos = count($this->subasta->get_by_subasta_id($item->subasta_id));

            $item->subasta_user =  $this->subasta->get_subasta_user($user_id, $item->subasta_id);

            $item->puja =  $this->subasta->get_puja_alta($item->subasta_id);
        }

        $data['all_subastas'] = $all_subastas;
        $data['resultados'] = $contador;
        if ($offset == 0) {
            if ($contador == 0) {
                $data['inicio'] = 0;
                $data['fin'] = 0;
            } else {
                $data['inicio'] = 1;
                if ($contador >= 5) {
                    $data['fin'] =  5;
                } else {
                    $data['fin'] = $contador;
                }
            }
        } else {
            $data['inicio'] = $offset + 1;
            $intervalo = 5 + $offset;
            if ($intervalo > $contador) {
                $data['fin'] = $contador;
            } else {
                $data['fin'] = $intervalo;
            }
        }


        $this->load_view_front('front/subastas', $data);
    }
    public function subasta_directa()
    {
        $this->session->set_userdata('session_categoria_subasta', NULL);
        $this->session->set_userdata('session_ciudad_subasta', NULL);
        $this->session->set_userdata('session_categoria', null);
        $this->session->set_userdata('session_palabra', null);
        $this->load->model('Pais_model', 'pais');
        $this->session->set_userdata('page', 'subasta_directa');
        $this->load->model('Subasta_model', 'subasta');
        $this->load->model('Categoria_model', 'category');

        $categories = $this->category->get_all();
        $data['categories'] = $categories;

        $subcat = $this->category->get_all_subasta_subcat();
        $data['subcat'] = $subcat;
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 2]); //todos los banners
        $data['all_banners'] = $all_banners;
        /* URL a la que se desea agregar la paginación*/
        $config['base_url'] = site_url('subastas_directas/page/');

        /*Obtiene el total de registros a paginar */

        $contador = count($this->subasta->get_subastas_directas());
        $config['total_rows'] = $contador;
        $user_id = $this->session->userdata('user_id');

        /*Obtiene el numero de registros a mostrar por pagina */
        if ($contador > 5) {
            $config['per_page'] = '5';
        } else {
            $config['per_page'] = (string) $contador;
        }

        $config['uri_segment'] = 3;
        /*Se personaliza la paginación para que se adapte a bootstrap*/

        $config['cur_tag_open'] = '<li class="active"><a href="#">';

        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';

        $config['num_tag_close'] = '</li>';

        $config['last_link'] = FALSE;

        $config['first_link'] = FALSE;

        $config['next_link'] = '&raquo;';

        $config['next_tag_open'] = '<li>';

        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';

        $config['prev_tag_open'] = '<li>';

        $config['prev_tag_close'] = '</li>';


        /* Se inicializa la paginacion*/

        $this->pagination->initialize($config);
        $page = $this->uri->segment(3);

        $offset = !$page ? 0 : $page;
        //      $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        $all_subastas = $this->subasta->get_all_by_subastas_with_pagination($config['per_page'], $offset, 1);
        $subcat_id = "";
        foreach ($all_subastas as $item) {
            $long = strlen($item->descrip_espa);
            $subcat_id = $item->subcat_id;
            if ($long > 185) {
                $item->corta = substr($item->descrip_espa, 0, 185) . "...";
            } else {

                $item->corta = $item->descrip_espa;
            }
            $nombre = strlen($item->nombre_espa);

            if ($nombre > 100) {
                $item->corto = substr($item->nombre_espa, 0, 100) . "...";
            } else {

                $item->corto = $item->nombre_espa;
            }
            $item->contador_fotos = count($this->subasta->get_by_subasta_id($item->subasta_id));

            $item->subasta_user =  $this->subasta->get_subasta_user($user_id, $item->subasta_id);

            $puja =  $this->subasta->get_puja_alta($item->subasta_id);
            $item->puja = $puja;
            if ($puja) {
                $user_win = $this->subasta->get_user_puja_alta($puja->valor);
            } else {
                $user_win = null;
            }
            if ($user_id) {
                $subasta_user =  $this->subasta->get_subasta_user($user_id, $item->subasta_id);
                $puja_user = $this->subasta->get_puja_alta_user($item->subasta_id, $user_id);
            } else {
                $subasta_user = null;
                $puja_user = null;
            }
            $item->subasta_user = $subasta_user;
            $item->puja_user = $puja_user;
            $item->user_win = $user_win;
        }
        $data['subcat_id'] = $subcat_id;
        $all_ciudad = $this->pais->get_by_pais_id_object(4);
        $data['all_ciudad'] = $all_ciudad;
        $data['all_subastas'] = $all_subastas;
        $data['resultados'] = $contador;
        if ($offset == 0) {
            $data['inicio'] = 1;
            if ($contador >= 5) {
                $data['fin'] =  5;
            } else {
                $data['fin'] =  $contador;
            }
        } else {
            $data['inicio'] = $offset + 1;
            $intervalo = 5 + $offset;
            if ($intervalo > $contador) {
                $data['fin'] = $contador;
            } else {
                $data['fin'] = $intervalo;
            }
        }
        $tipo = 1;

        $data['tipo'] = $tipo;




        $this->load_view_front('front/subastas', $data);
    }
    public function subasta_inversa()
    {
        $this->session->set_userdata('session_categoria_subasta', NULL);
        $this->session->set_userdata('session_ciudad_subasta', NULL);
        $this->session->set_userdata('page', 'subasta_inversa');
        $this->load->model('Subasta_model', 'subasta');
        $this->load->model('Categoria_model', 'category');
        $this->load->model('Pais_model', 'pais');
        $categories = $this->category->get_all();
        $data['categories'] = $categories;
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 2]); //todos los banners
        $data['all_banners'] = $all_banners;
        /* URL a la que se desea agregar la paginación*/
        $config['base_url'] = site_url('subastas_inversas/page/');
        $subcat = $this->category->get_all_subasta_subcat();
        $data['subcat'] = $subcat;
        /*Obtiene el total de registros a paginar */

        $contador = count($this->subasta->get_subastas_inversas());
        $config['total_rows'] = $contador;
        $user_id = $this->session->userdata('user_id');

        /*Obtiene el numero de registros a mostrar por pagina */

        if ($contador >= 5) {
            $config['per_page'] = '5';
        } else {

            $config['per_page'] = (string) $contador;
        }

        $config['uri_segment'] = 3;
        /*Se personaliza la paginación para que se adapte a bootstrap*/

        $config['cur_tag_open'] = '<li class="active"><a href="#">';

        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';

        $config['num_tag_close'] = '</li>';

        $config['last_link'] = FALSE;

        $config['first_link'] = FALSE;

        $config['next_link'] = '&raquo;';

        $config['next_tag_open'] = '<li>';

        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';

        $config['prev_tag_open'] = '<li>';

        $config['prev_tag_close'] = '</li>';


        /* Se inicializa la paginacion*/

        $this->pagination->initialize($config);
        $page = $this->uri->segment(3);

        $offset = !$page ? 0 : $page;
        //      $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $subcat_id = "";



        $all_subastas = $this->subasta->get_all_by_subastas_with_pagination($config['per_page'], $offset, 2);

        foreach ($all_subastas as $item) {
            $item->contador_fotos = count($this->subasta->get_by_subasta_id($item->subasta_id));
            $long = strlen($item->descrip_espa);
            $subcat_id = $item->subcat_id;
            if ($long > 185) {
                $item->corta = substr($item->descrip_espa, 0, 185) . "...";
            } else {

                $item->corta = $item->descrip_espa;
            }
            $nombre = strlen($item->nombre_espa);

            if ($nombre > 100) {
                $item->corto = substr($item->nombre_espa, 0, 100) . "...";
            } else {

                $item->corto = $item->nombre_espa;
            }
            $item->subasta_user =  $this->subasta->get_subasta_user($user_id, $item->subasta_id);
            $item->intervalo = $this->subasta->get_intervalo_subasta($item->subasta_id);
            $item->puja =  $this->subasta->get_puja_alta($item->subasta_id);
        }
        $all_ciudad = $this->pais->get_by_pais_id_object(4);
        $data['subcat_id'] = $subcat_id;
        $data['all_ciudad'] = $all_ciudad;
        $data['all_subastas'] = $all_subastas;
        $data['resultados'] = $contador;
        if ($offset == 0) {
            $data['inicio'] = 1;
            if ($contador >= 5) {
                $data['fin'] =  5;
            } else {
                $data['fin'] =  $contador;
            }
        } else {
            $data['inicio'] = $offset + 1;
            $intervalo = 5 + $offset;
            if ($intervalo > $contador) {
                $data['fin'] = $contador;
            } else {
                $data['fin'] = $intervalo;
            }
        }
        $data['tipo'] = 2;


        $this->load_view_front('front/subastas', $data);
    }
    public function anuncios_index()
    {
        $subcate = "";
        $this->load->model('Banner_model', 'banner');
        $this->load->model('Pais_model', 'pais');
        $all_banners = $this->banner->get_all(['menu_id' => 3]); //todos los banners
        $data['all_banners'] = $all_banners;
        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Cate_anuncio_model', 'category');

        $categories = $this->category->get_all();

        foreach ($categories as $item) {

            $item->count = count($this->anuncio->get_anuncios_by_category($item->cate_anuncio_id));
        }


        $data['subcate'] = $subcate;
        $data['categories'] = $categories;
        /* URL a la que se desea agregar la paginación*/
        $config['base_url'] = site_url('anuncios/page/');

        /*Obtiene el total de registros a paginar */

        $contador = count($this->anuncio->get_anuncios());
        $config['total_rows'] = $contador;
        $user_id = $this->session->userdata('user_id');

        /*        if ($contador >= 8) {

            $config['per_page'] = '8';
        } else {

            $config['per_page'] = (string) $contador;
        } */

        /*Obtiene el numero de registros a mostrar por pagina */

        $config['uri_segment'] = 3;
        /*Se personaliza la paginación para que se adapte a bootstrap*/
        $config['per_page'] = '8';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';

        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';

        $config['num_tag_close'] = '</li>';

        $config['last_link'] = FALSE;

        $config['first_link'] = FALSE;

        $config['next_link'] = '&raquo;';

        $config['next_tag_open'] = '<li>';

        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';

        $config['prev_tag_open'] = '<li>';

        $config['prev_tag_close'] = '</li>';


        /* Se inicializa la paginacion*/

        $this->pagination->initialize($config);
        $page = $this->uri->segment(3);
        $offset = !$page ? 0 : $page;

        $all_anuncios = $this->anuncio->get_all_anuncios_with_pagination($config['per_page'], $offset);
        foreach ($all_anuncios as $item) {
            $long = strlen($item->descripcion);

            if ($long > 150) {
                $item->corta = substr($item->descripcion, 0, 150) . "...";
            } else {

                $item->corta = $item->descripcion;
            }
            $nombre = strlen($item->titulo);

            if ($nombre > 54) {
                $item->corto = substr($item->titulo, 0, 54) . "...";
            } else {

                $item->corto = $item->titulo;
            }
        }
        $data['all_anuncios'] = $all_anuncios;
        $data['resultados'] = $contador;
        $recientes = $this->anuncio->get_all_anuncios_recientes();
        foreach ($recientes as $item) {
            $long = strlen($item->titulo);

            if ($long > 22) {
                $item->titulo_corto = substr($item->titulo, 0, 22) . "...";
            } else {

                $item->titulo_corto = $item->titulo;
            }
        }
        $data['recientes'] = $recientes;
        $destacados = $this->anuncio->get_all_anuncios_destacados();
        foreach ($destacados as $item) {
            $long = strlen($item->titulo);

            if ($long > 20) {
                $item->titulo_corto = substr($item->titulo, 0, 20) . "...";
            } else {

                $item->titulo_corto = $item->titulo;
            }
        }
        $data['destacados'] = $destacados;
        $data['contador'] = $contador;


        $subcategoria = $this->category->get_all_subcate();

        $data['subcategoria'] = $subcategoria;

        $all_ciudad = $this->pais->get_by_pais_id_object(4);

        $data['all_ciudad'] = $all_ciudad;
        if ($offset == 0) {
            if ($contador == 0) {
                $data['inicio'] = 0;
                $data['fin'] = 0;
            } else {
                $data['inicio'] = 1;
                if ($contador >= 8) {
                    $data['fin'] =  8;
                } else {
                    $data['fin'] = $contador;
                }
            }
        } else {
            $data['inicio'] = $offset + 1;
            $intervalo = 8 + $offset;
            if ($intervalo > $contador) {
                $data['fin'] = $contador;
            } else {
                $data['fin'] = $intervalo;
            }
        }

        $this->load_view_front('front/anuncios', $data);
    }

    public function buscar_anuncio()
    {
        header('Cache-Control: no cache');
        $this->load->model('Pais_model', 'pais');
        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Cate_anuncio_model', 'category');
        $categories = $this->category->get_all();
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 3]);
        $data['all_banners'] = $all_banners;

        foreach ($categories as $item) {
            $item->count = count($this->anuncio->get_anuncios_by_category($item->cate_anuncio_id));
        }
        $data['categories'] = $categories;

        $subcategoria = $this->category->get_all_subcate();
        $data['subcategoria'] = $subcategoria;

        $anuncio_palabra = $this->input->post('anuncio_palabra');
        $category = $this->input->post('category');

        $ciudad_id = $this->input->post('ciudad_id');
        if ($ciudad_id != NULL) {
            if ($ciudad_id == 0) {
                $this->session->set_userdata('session_ciudad', NULL);
            } else {
                $this->session->set_userdata('session_ciudad', $ciudad_id);
            }
        } else {
            if ($this->session->userdata('session_ciudad')) {
                $ciudad_id = $this->session->userdata('session_ciudad');
            } else {
                $ciudad_id = 0;
            }
        }

        if ($category != NULL) {
            if ($category == 0) {
                $this->session->set_userdata('session_categoria', NULL);
            } else {
                $this->session->set_userdata('session_categoria', $category);
            }
        } else {
            if ($this->session->userdata('session_categoria')) {
                $category = $this->session->userdata('session_categoria');
            } else {
                $category = 0;
            }
        }

        $contador = count($this->anuncio->get_anuncio_palabra($anuncio_palabra, $ciudad_id, $category));

        /* URL a la que se desea agregar la paginación*/
        $config['base_url'] = site_url('search_anuncios/page/');

        /*Obtiene el total de registros a paginar */

        $config['total_rows'] = $contador;
        $user_id = $this->session->userdata('user_id');
        if ($contador >= 8) {
            $config['per_page'] = '8';
        } else {

            $config['per_page'] = (string) $contador;
        }
        /*Obtiene el numero de registros a mostrar por pagina */

        $config['uri_segment'] = 3;
        /*Se personaliza la paginación para que se adapte a bootstrap*/

        $config['cur_tag_open'] = '<li class="active"><a href="#">';

        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';

        $config['num_tag_close'] = '</li>';

        $config['last_link'] = FALSE;

        $config['first_link'] = FALSE;

        $config['next_link'] = '&raquo;';

        $config['next_tag_open'] = '<li>';

        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';

        $config['prev_tag_open'] = '<li>';

        $config['prev_tag_close'] = '</li>';

        /* Se inicializa la paginacion*/

        $this->pagination->initialize($config);
        $page = $this->uri->segment(3);
        $subcate = "";

        $offset = !$page ? 0 : $page;
        $all_anuncios = $this->anuncio->get_all_anuncios_with_pagination_by_name($config['per_page'], $offset, $anuncio_palabra, $ciudad_id, $category);
        foreach ($all_anuncios as $item) {
            $long = strlen($item->descripcion);
            $subcate = $item->subcate_id;

            if ($long > 150) {
                $item->corta = substr($item->descripcion, 0, 150) . "...";
            } else {

                $item->corta = $item->descripcion;
            }
            $nombre = strlen($item->titulo);

            if ($nombre > 54) {
                $item->corto = substr($item->titulo, 0, 54) . "...";
            } else {

                $item->corto = $item->titulo;
            }
        }

        $data['subcate'] = $subcate;
        $data['all_anuncios'] = $all_anuncios;
        $data['resultados'] = $contador;
        if ($offset == 0) {
            if ($contador == 0) {
                $data['inicio'] = 0;
                $data['fin'] = 0;
            } else {
                $data['inicio'] = 1;
                if ($contador >= 8) {
                    $data['fin'] =  8;
                } else {
                    $data['fin'] = $contador;
                }
            }
        } else {
            $data['inicio'] = $offset + 1;
            $intervalo = 8 + $offset;
            if ($intervalo > $contador) {
                $data['fin'] = $contador;
            } else {
                $data['fin'] = $intervalo;
            }
        }
        $recientes = $this->anuncio->get_all_anuncios_recientes();
        foreach ($recientes as $item) {
            $long = strlen($item->titulo);

            if ($long > 22) {
                $item->titulo_corto = substr($item->titulo, 0, 22) . "...";
            } else {

                $item->titulo_corto = $item->titulo;
            }
        }
        $data['recientes'] = $recientes;
        $destacados = $this->anuncio->get_all_anuncios_destacados();
        foreach ($destacados as $item) {
            $long = strlen($item->titulo);

            if ($long > 20) {
                $item->titulo_corto = substr($item->titulo, 0, 20) . "...";
            } else {

                $item->titulo_corto = $item->titulo;
            }
        }
        $all_ciudad = $this->pais->get_by_pais_id_object(4);

        $data['all_ciudad'] = $all_ciudad;
        $data['destacados'] = $destacados;
        $data['contador'] = $contador;



        $this->load_view_front('front/anuncios', $data);
    }

    ////

    public function busquedade_anuncio()
    {
        $mastercat = $this->input->post("category");
        if ($mastercat == "") {
        } else {
            $data["mastercat"] = $this->input->post("category");
        }

        header('Cache-Control: no cache');
        $this->load->model('Pais_model', 'pais');
        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Cate_anuncio_model', 'category');
        $categories = $this->category->get_all();
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 3]);
        $data['all_banners'] = $all_banners;

        foreach ($categories as $item) {
            $item->count = count($this->anuncio->get_anuncios_by_category($item->cate_anuncio_id));
        }

        $data['categories'] = $categories;

        $subcategoria = $this->category->get_all_subcate();
        $data['subcategoria'] = $subcategoria;

        $anuncio_palabra = $this->input->post('anuncio_palabra');
        $category = $this->input->post('category');

        $ciudad_id = $this->input->post('ciudad_id');
        if ($ciudad_id != NULL) {
            if ($ciudad_id == 0) {
                $this->session->set_userdata('session_ciudad', NULL);
            } else {
                $this->session->set_userdata('session_ciudad', $ciudad_id);
            }
        } else {
            if ($this->session->userdata('session_ciudad')) {
                $ciudad_id = $this->session->userdata('session_ciudad');
            } else {
                $ciudad_id = 0;
            }
        }

        if ($category != NULL) {
            if ($category == 0) {
                $this->session->set_userdata('session_categoria', NULL);
            } else {
                $this->session->set_userdata('session_categoria', $category);
            }
        } else {
            if ($this->session->userdata('session_categoria')) {
                $category = $this->session->userdata('session_categoria');
            } else {
                $category = 0;
            }
        }

        //$contador = count($this->anuncio->get_anuncio_palabra($anuncio_palabra, $ciudad_id, $category));
        $contador = count($this->anuncio->get_anuncios_by_category2($category));
        /* URL a la que se desea agregar la paginación*/
        $config['base_url'] = site_url('search_anuncios/page/');

        /*Obtiene el total de registros a paginar */

        $config['total_rows'] = $contador;
        $user_id = $this->session->userdata('user_id');
        if ($contador >= 8) {
            $config['per_page'] = '8';
        } else {

            $config['per_page'] = (string) $contador;
        }
        /*Obtiene el numero de registros a mostrar por pagina */

        $config['uri_segment'] = 3;
        /*Se personaliza la paginación para que se adapte a bootstrap*/

        $config['cur_tag_open'] = '<li class="active"><a href="#">';

        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';

        $config['num_tag_close'] = '</li>';

        $config['last_link'] = FALSE;

        $config['first_link'] = FALSE;

        $config['next_link'] = '&raquo;';

        $config['next_tag_open'] = '<li>';

        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';

        $config['prev_tag_open'] = '<li>';

        $config['prev_tag_close'] = '</li>';

        /* Se inicializa la paginacion*/

        $this->pagination->initialize($config);
        $page = $this->uri->segment(3);
        $subcate = "";

        $offset = !$page ? 0 : $page;
        $all_anuncios = $this->anuncio->get_anuncios_by_category2($category);
        foreach ($all_anuncios as $item) {
            $long = strlen($item->descripcion);
            $subcate = $item->subcate_id;

            if ($long > 150) {
                $item->corta = substr($item->descripcion, 0, 150) . "...";
            } else {

                $item->corta = $item->descripcion;
            }
            $nombre = strlen($item->titulo);

            if ($nombre > 54) {
                $item->corto = substr($item->titulo, 0, 54) . "...";
            } else {

                $item->corto = $item->titulo;
            }
        }

        $data['subcate'] = $subcate;
        $data['all_anuncios'] = $all_anuncios;
        $data['resultados'] = $contador;
        if ($offset == 0) {
            if ($contador == 0) {
                $data['inicio'] = 0;
                $data['fin'] = 0;
            } else {
                $data['inicio'] = 1;
                if ($contador >= 8) {
                    $data['fin'] =  8;
                } else {
                    $data['fin'] = $contador;
                }
            }
        } else {
            $data['inicio'] = $offset + 1;
            $intervalo = 8 + $offset;
            if ($intervalo > $contador) {
                $data['fin'] = $contador;
            } else {
                $data['fin'] = $intervalo;
            }
        }
        $recientes = $this->anuncio->get_all_anuncios_recientes();
        foreach ($recientes as $item) {
            $long = strlen($item->titulo);

            if ($long > 22) {
                $item->titulo_corto = substr($item->titulo, 0, 22) . "...";
            } else {

                $item->titulo_corto = $item->titulo;
            }
        }
        $data['recientes'] = $recientes;
        $destacados = $this->anuncio->get_all_anuncios_destacados();
        foreach ($destacados as $item) {
            $long = strlen($item->titulo);

            if ($long > 20) {
                $item->titulo_corto = substr($item->titulo, 0, 20) . "...";
            } else {

                $item->titulo_corto = $item->titulo;
            }
        }
        $all_ciudad = $this->pais->get_by_pais_id_object(4);

        $data['all_ciudad'] = $all_ciudad;
        $data['destacados'] = $destacados;
        $data['contador'] = $contador;



        $this->load_view_front('front/anuncios', $data);
    }
    ////

    public function about()
    {

        $this->load->model('Empresa_model', 'empresa');
        $this->load->model('Membresia_model', 'membresia');
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 3]); //todos los banners
        $data_object['all_banners'] = $all_banners;

        $empresa_id = $this->input->post('empresa_id');

        $empresa_object = $this->empresa->get_by_id($empresa_id);

        $all_membresia = $this->membresia->get_all();

        $data_object['all_membresia'] = $all_membresia;

        $data['empresa_object'] = $empresa_object;



        $this->load_view_front('front/about', $data_object);
    }
    public function prueba()
    {

        $this->load_view_front('front/vacio');
    }
    public function membresia()
    {

        $this->load->model('Empresa_model', 'empresa');
        $this->load->model('Membresia_model', 'membresia');
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 3]); //todos los banners
        $data_object['all_banners'] = $all_banners;

        $user_id = $this->session->userdata('user_id');
        $empresa_id = $this->input->post('empresa_id');

        $empresa_object = $this->empresa->get_by_id($empresa_id);

        $all_membresia = $this->membresia->get_all();

        $data_object['all_membresia'] = $all_membresia;

        $data['empresa_object'] = $empresa_object;

        $this->load_view_front('front/membresia', $data_object);
    }

    public function perfil()
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            $this->log_out();
            redirect('login');
        }

        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('User_model', 'user');
        $this->load->model('Cate_anuncio_model', 'cate_anuncio');
        $this->load->model('Pais_model', 'pais');
        $this->load->model('Membresia_model', 'membresia');
        $this->load->model('Subasta_model', 'subasta');
        $user_id = $this->session->userdata('user_id');
        $ciudad_id = $this->session->userdata('ciudad_id');
        $this->load->model('Banner_model', 'banner');
        $this->load->model('payment_model', 'payment');
        $payments = $this->payment->get_by_payment_user_id_all($user_id);
        $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
        $data['all_banners'] = $all_banners;
        $data['payments'] = $payments;
        $mis_subastas = $this->subasta->get_subastas_directas_by_user($user_id);
        $subastas_inversas = $this->subasta->get_subastas_inversas_by_user($user_id);
        foreach ($subastas_inversas as $item) {
            $long = strlen($item->descrip_espa);
            $nombre = strlen($item->nombre_espa);

            if ($nombre > 54) {
                $item->titulo_corto = substr($item->nombre_espa, 0, 54) . "...";
            } else {

                $item->titulo_corto = $item->nombre_espa;
            }
            if ($long > 185) {
                $item->corta = substr($item->descrip_espa, 0, 185) . "...";
            } else {

                $item->corta = $item->descrip_espa;
            }
            $item->contador_fotos = count($this->subasta->get_by_subasta_id($item->subasta_id));
            $item->subasta_user =  $this->subasta->get_subasta_user($user_id, $item->subasta_id);
            $item->intervalo = null;
            $puja =  $this->subasta->get_puja_alta($item->subasta_id);
            $item->puja = $puja;
            if ($puja) {
                $user_win = $this->subasta->get_user_puja_alta($puja->valor);
            } else {
                $user_win = null;
            }
            if ($user_id) {
                $subasta_user =  $this->subasta->get_subasta_user($user_id, $item->subasta_id);
                $puja_user = $this->subasta->get_puja_alta_user($item->subasta_id, $user_id);
            } else {
                $subasta_user = null;
                $puja_user = null;
            }
            $item->subasta_user = $subasta_user;
            $item->puja_user = $puja_user;
            $item->user_win = $user_win;
        }

        foreach ($mis_subastas as $item) {
            $long = strlen($item->descrip_espa);
            $nombre = strlen($item->nombre_espa);

            if ($nombre > 54) {
                $item->titulo_corto = substr($item->nombre_espa, 0, 54) . "...";
            } else {

                $item->titulo_corto = $item->nombre_espa;
            }
            if ($long > 185) {
                $item->corta = substr($item->descrip_espa, 0, 185) . "...";
            } else {

                $item->corta = $item->descrip_espa;
            }
            $item->contador_fotos = count($this->subasta->get_by_subasta_id($item->subasta_id));

            $item->subasta_user =  $this->subasta->get_subasta_user($user_id, $item->subasta_id);

            $puja =  $this->subasta->get_puja_alta($item->subasta_id);

            $item->puja = $puja;
            if ($puja) {
                // $user_win = $this->subasta->get_user_puja_alta($puja->valor);
                $user_win = $this->subasta->get_puja_alta_obj($item->subasta_id);
            } else {
                $user_win = null;
            }
            if ($user_id) {
                $subasta_user =  $this->subasta->get_subasta_user($user_id, $item->subasta_id);
                $puja_user = $this->subasta->get_puja_alta_user($item->subasta_id, $user_id);
            } else {
                $subasta_user = null;
                $puja_user = null;
            }
            $item->subasta_user = $subasta_user;
            $item->puja_user = $puja_user;
            $item->user_win = $user_win;
        }

        $all_anuncios = $this->anuncio->get_all(['user_id' => $user_id, 'is_delete' => 0]);

        $config['base_url'] = site_url('perfil/page/');

        /*Obtiene el total de registros a paginar */
        $contador = count($all_anuncios);
        $config['total_rows'] = $contador;


        /*Obtiene el numero de registros a mostrar por pagina */
        $config['per_page'] = '6';
        $config['uri_segment'] = 3;
        /*Se personaliza la paginación para que se adapte a bootstrap*/

        $config['cur_tag_open'] = '<li class="active"><a href="#">';

        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';

        $config['num_tag_close'] = '</li>';

        $config['last_link'] = FALSE;

        $config['first_link'] = FALSE;

        $config['next_link'] = '&raquo;';

        $config['next_tag_open'] = '<li>';

        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';

        $config['prev_tag_open'] = '<li>';

        $config['prev_tag_close'] = '</li>';


        /* Se inicializa la paginacion*/

        $this->pagination->initialize($config);
        $page = $this->uri->segment(3);
        if ($page) {
            if ($page >= 4) {
                $this->session->set_userdata('validando', 2);
            }
        }
        $offset = !$page ? 0 : $page;
        $anuncios_partes = $this->anuncio->get_all_by_anuncios_with_pagination($user_id, $config['per_page'], $offset);

        foreach ($anuncios_partes as $item) {
            $nombre = strlen($item->titulo);

            if ($nombre > 54) {
                $item->titulo_corto = substr($item->titulo, 0, 54) . "...";
            } else {

                $item->titulo_corto = $item->titulo;
            }
            $subcate_object = $this->cate_anuncio->get_by_subcate_id_object($item->subcate_id);

            $item->subcate =  $subcate_object;

            $all_ciudad = $this->pais->get_by_ciudad_id_object($item->ciudad_id);

            $item->ciudad = $all_ciudad;
        }

        $data['all_anuncios'] = $anuncios_partes;

        $data['resultados'] = $contador;
        if ($offset == 0) {
            $data['inicio'] = 1;
            $data['fin'] =  6;
        } else {
            $data['inicio'] = $offset + 1;
            $intervalo = 6 + $offset;
            if ($intervalo > $contador) {
                $data['fin'] = $contador;
            } else {
                $data['fin'] = $intervalo;
            }
        }

        $user_membresia = $this->membresia->get_membresia_by_user_id($user_id);
        if ($user_membresia) {
            $all_membresia = $this->membresia->get_by_id($user_membresia->membresia_id);
        } else {
            $all_membresia = null;
        }


        $city = $this->pais->get_by_city_all($ciudad_id);
        $all_pais = $this->pais->get_all();
        $data['all_pais'] = $all_pais;
        $all_ciudad = $this->pais->get_by_pais_id_object(4);

        $data['contador_anuncios'] = $contador;
        $data['all_ciudad'] = $all_ciudad;
        $data['city'] = $city;
        $data['all_membresia'] = $all_membresia;
        $data['user_data'] = $this->user->get_by_id($user_id);
        $data['mis_subastas_inversas'] = $subastas_inversas;
        $data['mis_subastas_directas'] = $mis_subastas;
        $data['user_membresia'] = $user_membresia;


        $this->load_view_front('front/perfil', $data);
    }
    public function contacto_mensaje()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $mensaje_text = $this->input->post('mensaje');


        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('email', translate("email_lang"), 'required');
        $this->form_validation->set_rules('mensaje', translate('message_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("contacto");
        } else {
            $this->load->model("Mensaje_model", "mensaje");
            $data = [
                'name' => $name,
                'email' => $email,
                'mensaje' => $mensaje_text,
                'is_active' => 1,
                'fecha_creacion' => date("Y-m-d H:i:s"),

            ];

            $this->mensaje->create($data);

            $fecha = date('Y-m-d H:i:s');
            $mensaje = "<h5>Fecha: " . $fecha . "</h5>" . "<h5>Email: " . $email . "</h5>" . "<h5>Nombre: " . $name . "</h5>" . "<br>Mensaje: " . $mensaje_text;

            $this->load->library('email');

            $config['protocol'] = 'smtp';
            $config['smtp_host'] = 'smtp.zoho.com';
            $config['smtp_user'] = 'info@datalabcenter.com';
            $config['smtp_pass'] = "Q12we34rt5";
            $config['smtp_port'] = '465';
            //$config['smtp_timeout'] = '5';
            //$config['smtp_keepalive'] = TRUE;
            $config['smtp_crypto'] = 'ssl';
            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['mailtype'] = 'html';
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);

            $this->email->from('pedro@datalabcenter.com', '_mensaje Página Web');
            $this->load->model('Empresa_model', 'empresa');
            $empresa_object = $this->empresa->get_by_id(1);
            $correo_empresa = $empresa_object->email;
            $this->email->to($correo_empresa);

            $this->email->message($mensaje);

            // $result = $this->email->send();

            $this->email->send();

            $this->response->set_message(translate('mensaje_contacto_lang'), ResponseMessage::SUCCESS);
            redirect("contacto");
        }
    }
    public function pagar_membresia()
    {
        $user_id = $this->session->userdata('user_id');
        $email = $this->session->userdata('email');
        $membresia = $this->input->post('membresia_id');
        $this->load->model('Membresia_model', 'membresia');
        $object_membresia = $this->membresia->get_by_id($membresia);
        $fecha = date('Y-m-d H:i:s');
        $fecha_fin = strtotime('+364 day', strtotime($fecha));
        $fecha_fin = date('Y-m-d H:i:s', $fecha_fin);
        $fecha_mes = strtotime('+30 day', strtotime($fecha));
        $fecha_mes = date('Y-m-d', $fecha_mes);
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
        $id = $this->membresia->create_membresia_user($data);
        if ($id) {
            $this->load->model("Correo_model", "correo");
            $asunto = "Membresia adquirida";
            $motivo = 'Membresia adquirida Subasta anuncios';
            $mensaje = "<p><img style='width:209px;heigth:44px' src='https://subastanuncios.com/assets/logo_subasta.png'></p>";
            $mensaje .= "<h3>Membresía “" . $object_membresia->nombre . "”</h3>";
            $mensaje .= "¡Felicitaciones! <br>Nos complace informarte que has adquirido una nueva membresía, mediante la cual tendrás acceso a los siguientes beneficios:<br>";
            $mensaje .= "" . $object_membresia->descripcion . "<br>";
            $mensaje .= "Tu usuario " . $email . ", tendrá activa esta membresía hasta " . $fecha_fin . ". Para seguir gestionando las ventajas de tu membresía, recuerda renovarla antes de cumplir la anualidad.<br>";
            $mensaje .= "Si necesitas contactar con nosotros puedes hacerlo a través del email comercial@suabastanuncios.com <br>";
            $mensaje .= "Gracias por sumarte a nuestra plataforma<br>";
            $mensaje .= "Saludos,<br>";
            $mensaje .= "El equipo de SUBASTANUNCIOS";
            $this->correo->sent($email, $mensaje, $asunto, $motivo);
        }

        $this->response->set_message(translate('adquirir_membresia_lang'), ResponseMessage::SUCCESS);
        $this->session->set_userdata('validando', 1);
        redirect("perfil/page/");
    }

    public function pagar_entrada()
    {
        $user_id = $this->session->userdata('user_id');
        $subasta_id = $this->input->post('subasta_id');
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
            'is_active' => 1
        ];
        $this->subasta->create_subasta_user($data);
        $this->response->set_message(translate('piso_pagado_lang'), ResponseMessage::SUCCESS);
        redirect("perfil");
    }
    public function pagar_entrada_ajax()
    {
        $user_id = $this->session->userdata('user_id');

        if ($user_id) {
            $subasta_id = $this->input->post('subasta_id');
            $this->load->model('Subasta_model', 'subasta');
            $this->load->model('Membresia_model', 'membresia');
            $membresia = $this->membresia->get_membresia_by_user_id($user_id);

            if ($membresia) {

                $qty = (int) $membresia->qty_subastas;

                if ($qty > 0) {
                    $resta = $qty - 1;
                    $this->membresia->update_membresia_user($membresia->membre_user_id, ['qty_subastas' => $resta]);
                }
            }

            $data = [
                'user_id' => $user_id,
                'subasta_id' => $subasta_id,
                'is_active' => 1
            ];
            $id = $this->subasta->create_subasta_user($data);
            if ($id) {
                $data['status'] = 200;
                $data['membresia'] = $membresia;
            } else {
                $data['membresia'] = $membresia;
                $data['status'] = 500;
            }
            echo json_encode($data);
            exit();
        } else {
            $data['status'] = 500;
            $data['membresia'] = $membresia;
            echo json_encode($data);
            exit();
        }


        // $this->response->set_message(translate('piso_pagado_lang'), ResponseMessage::SUCCESS);
        // redirect("perfil");
    }
    public function pagar_inversa()
    {
        $user_id = $this->session->userdata('user_id');
        $subasta_id = $this->input->post('invresa_subasta_id');
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
            'intervalo_subasta_id' => $subasta[$count - 1]->intervalo_subasta_id
        ];
        $this->subasta->create_subasta_user($data);
        $this->response->set_message(translate('compra_exitosa_lang'), ResponseMessage::SUCCESS);
        redirect("perfil");
    }
    public function pujar_ajax()
    {
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $subasta_user_id = $this->input->post('subasta_user_id');
            $valor = $this->input->post('valor_pujando');
            $this->load->model('Subasta_model', 'subasta');
            $obj_subasta_user = $this->subasta->get_by_subasta_user($subasta_user_id);
            $puja =  $this->subasta->get_puja_alta($obj_subasta_user->subasta_id);
            if ($puja->valor != "null") {
                if ((float) $valor > (float) $puja->valor) {
                    $data = [
                        'subasta_user_id' => $subasta_user_id,
                        'fecha_hora' => date('Y-m-d H:i:s'),
                        'valor' => $valor
                    ];
                    $id = $this->subasta->create_puja($data);
                    if ($id) {
                        $data['status'] = 200;
                        $data['subasta_id'] = $obj_subasta_user->subasta_id;
                    } else {
                        $data['status'] = 500;
                    }
                } else {
                    $data['status'] = 500;
                }
            } else {
                $data = [
                    'subasta_user_id' => $subasta_user_id,
                    'fecha_hora' => date('Y-m-d H:i:s'),
                    'valor' => $valor
                ];
                $id = $this->subasta->create_puja($data);
                if ($id) {
                    $data['status'] = 200;
                    $data['subasta_id'] = $obj_subasta_user->subasta_id;
                } else {
                    $data['status'] = 500;
                }
            }
            echo json_encode($data);
            exit();
        } else {
            $data['status'] = 500;
            echo json_encode($data);
            exit();
        }

        // $this->response->set_message(translate('pujar_valor_lang'), ResponseMessage::SUCCESS);
        // redirect("perfil");
    }
    public function pujar()
    {

        $subasta_user_id = $this->input->post('subasta_user_id');
        $valor = $this->input->post('valor_pujando');
        $this->load->model('Subasta_model', 'subasta');
        $data = [
            'subasta_user_id' => $subasta_user_id,
            'fecha_hora' => date('Y-m-d H:i:s'),
            'valor' => $valor
        ];
        $this->subasta->create_puja($data);
        $this->response->set_message(translate('pujar_valor_lang'), ResponseMessage::SUCCESS);
        redirect("perfil");
    }
    public function desactivar()
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            $this->log_out();
            redirect('login');
        }

        $anuncio_id = $this->input->post('anuncio_id2');

        $this->load->model('Anuncio_model', 'anuncio');
        $anuncio_object = $this->anuncio->get_by_id($anuncio_id);

        if ($anuncio_object->is_active == 0) {
            $this->anuncio->update($anuncio_id, ['is_active' => 1]);
            $this->response->set_message(translate('activar_ads_noti_lang'), ResponseMessage::SUCCESS);
            redirect("perfil/page/");
        } else {
            $this->anuncio->update($anuncio_id, ['is_active' => 0]);
            $this->response->set_message(translate('desactivar_ads_noti_lang'), ResponseMessage::SUCCESS);
            redirect("perfil/page/");
        }
    }
    public function subasta_directas_ajax()
    {
        $this->load->model('Subasta_model', 'subasta');
        $user_id = $this->session->userdata('user_id');
        $all_subastas =  $this->subasta->get_subastas_directas();
        foreach ($all_subastas as $item) {
            $item->contador_fotos = count($this->subasta->get_by_subasta_id($item->subasta_id));

            $item->subasta_user =  $this->subasta->get_subasta_user($user_id, $item->subasta_id);

            $puja =  $this->subasta->get_puja_alta($item->subasta_id);
            $item->puja = $puja;
            if ($puja) {
                $user_win = $this->subasta->get_puja_alta_obj($item->subasta_id);
                //  $user_win = $this->subasta->get_user_puja_alta($puja->valor);
            } else {
                $user_win = null;
            }
            if ($user_id) {
                $subasta_user =  $this->subasta->get_subasta_user($user_id, $item->subasta_id);
                $puja_user = $this->subasta->get_puja_alta_user($item->subasta_id, $user_id);
            } else {
                $subasta_user = null;
                $puja_user = null;
            }
            $item->subasta_user = $subasta_user;
            $item->puja_user = $puja_user;
            $item->user_win = $user_win;
        }
        echo json_encode($all_subastas);
        exit();
    }
    public function subastas_ajax()
    {
        $this->load->model('Subasta_model', 'subasta');
        $fecha_actual = strtotime(date("Y-m-d H:i:00", time()));

        $all_subastas =  $this->subasta->get_subastas();
        foreach ($all_subastas as $item) {
            $fecha_cierre = strtotime($item->fecha_cierre);
            if ($fecha_actual   >= $fecha_cierre) {
                $this->subasta->update($item->subasta_id, ['is_open' => 0]);
            }
        }
        $all_subastas =  $this->subasta->get_subastas();
        echo json_encode($all_subastas);
        exit();
    }

    public function checkout()
    {
        require(APPPATH . "libraries/Curl.php");
        $this->load->model('payment_model', 'payment');
        $this->load->model('User_model', 'user');
        //carga de credenciales.
        $payment = $this->payment->get_by_credenciales();

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
        $user_id = $this->session->userdata('user_id');
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
        echo json_encode($response);
        exit();
    }
    //Método con rand()
    function generando_codigo()
    {
        $length = 8;
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $login = '6dd79d14d110adedc41f3fbab8e58461';
        $tranKey = 'h61ByK5IO930k2T8';
        $resultado = base64_encode(sha1($randomString . Date("Y-m-d\TH:i:sP") . $tranKey, true));
        $randomString = base64_encode($randomString);
        echo json_encode(['trakey' => $resultado, 'nonce' => $randomString, 'date' => Date("Y-m-d\TH:i:sP")]);
        exit();
    }
    public function pago_cancelada()
    {
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
        $data['all_banners'] = $all_banners;
        $this->load_view_front('front/fallida', $data);
    }
    public function transaccion()
    {
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
        $data['all_banners'] = $all_banners;
        $this->load_view_front('front/exitosa', $data);
    }
    public function pago_exitoso()
    {
        $this->load->model('payment_model', 'payment');
        $this->payment->create_prueba(["data" => "csm"]);
        $datos = file_get_contents('php://input');
        //     $this->payment->create_prueba(['data' => $datos]);
        $data = json_decode($datos, true);
        $requestId = $data['requestId'];
        $reference = $data['reference'];
        // $obj =  $this->payment->get_by_reference_id("RF-1586980027-28");
        $obj =  $this->payment->get_by_reference_id($reference);

        if ($obj) {
            $this->payment->update($obj->payment_id, ['request_id' => $requestId]);
            if ($data['status']['status'] == "APPROVED") {
                $status = 1;
            } elseif ($data['status']['status'] == "PENDING") {
                $status = 3;
            } elseif ($data['status']['status'] == "REJECTED") {
                $status = 2;
            } else {
                $status = 0;
            }
            $this->payment->update($obj->payment_id, ['status' => $status, 'request_id' => $requestId]);
            if ($status == 1) {
                if ($obj->tipo == 0) { //membresia
                    $user_id = $obj->user_id;
                    $this->load->model('User_model', 'user');
                    $user_obj = $this->user->get_by_id($user_id);
                    $this->load->model('Membresia_model', 'membresia');
                    $object_membresia = $this->membresia->get_by_id($obj->id);
                    $fecha = date('Y-m-d H:i:s');
                    $fecha_fin = strtotime('+364 day', strtotime($fecha));
                    $fecha_fin = date('Y-m-d H:i:s', $fecha_fin);
                    $fecha_mes = strtotime('+30 day', strtotime($fecha));
                    $fecha_mes = date('Y-m-d', $fecha_mes);
                    $data = [
                        'user_id' => $user_id,
                        'membresia_id' => $obj->id,
                        'fecha_inicio' => $fecha,
                        'fecha_fin' => $fecha_fin,
                        'fecha_mes' => $fecha_mes,
                        'anuncios_publi' => (int) $object_membresia->cant_anuncio,
                        'qty_subastas' => (int) $object_membresia->qty_subastas,
                        'estado' => 1,
                        'mes' => 1,
                        'payment_id' => $obj->payment_id
                    ];
                    $id = $this->membresia->create_membresia_user($data);
                    if ($id) {
                        $this->load->model("Correo_model", "correo");
                        $asunto = "Membresia adquirida";
                        $motivo = 'Membresia adquirida Subasta anuncios';
                        $mensaje = "<p><img style='width:209px;heigth:44px' src='https://subastanuncios.com/assets/logo_subasta.png'></p>";
                        $mensaje .= "<h3>Membresía “" . $object_membresia->nombre . "”</h3>";
                        $mensaje .= "¡Felicitaciones! <br>Nos complace informarte que has adquirido una nueva membresía, mediante la cual tendrás acceso a los siguientes beneficios:<br>";
                        $mensaje .= "" . $object_membresia->descripcion . "<br>";
                        $mensaje .= "Tu usuario " . $user_obj->email . ", tendrá activa esta membresía hasta " . $fecha_fin . ". Para seguir gestionando las ventajas de tu membresía, recuerda renovarla antes de cumplir la anualidad.<br>";
                        $mensaje .= "Si necesitas contactar con nosotros puedes hacerlo a través del email comercial@suabastanuncios.com <br>";
                        $mensaje .= "Gracias por sumarte a nuestra plataforma<br>";
                        $mensaje .= "Saludos,<br>";
                        $mensaje .= "El equipo de SUBASTANUNCIOS";
                        $this->correo->sent($user_obj->email, $mensaje, $asunto, $motivo);
                    }
                } elseif ($obj->tipo == 1) {
                    $user_id = $obj->user_id;
                    $subasta_id = $obj->id;
                    $this->load->model('Subasta_model', 'subasta');
                    $this->load->model('Membresia_model', 'membresia');
                    $membresia = $this->membresia->get_membresia_by_user_id($user_id);
                    if ($membresia) {
                        $qty = (int) $membresia->qty_subastas;
                        if ($qty > 0) {
                            $resta = $qty - 1;
                            $this->membresia->update_membresia_user($membresia->membre_user_id, ['qty_subastas' => $resta]);
                        }
                    }
                    $data = [
                        'user_id' => $user_id,
                        'subasta_id' => $subasta_id,
                        'is_active' => 1,
                        'payment_id' => $obj->payment_id
                    ];
                    $this->subasta->create_subasta_user($data);
                } elseif ($obj->tipo == 2) {
                    $this->load->model('Anuncio_model', 'anuncio');
                    $anuncio_id = $obj->id;
                    $fecha = date('Y-m-d');
                    $fecha_fin = strtotime('+30 day', strtotime($fecha));
                    $this->anuncio->update($anuncio_id, ['destacado' => 1, 'fecha_vencimiento' => $fecha_fin, 'payment_id' => $obj->payment_id]);
                } elseif ($obj->tipo == 3) {
                    $user_id = $obj->user_id;
                    $subasta_id = $obj->id;
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
                        'payment_id' => $obj->payment_id
                    ];
                    $this->subasta->create_subasta_user($data);
                }
            }
        }
    }
    public function update_request_id()
    {
        $this->load->model('payment_model', 'payment');
        $request_id = $this->input->post('request_id');
        $reference = $this->input->post('reference');
        $status = $this->input->post('status');
        $obj = $this->payment->get_by_reference_id($reference);
        if ($obj) {
            $this->payment->update($obj->payment_id, ['status' => $status, 'request_id' => $request_id]);
            echo json_encode(['status' => 200]);
        } else {
            echo json_encode(['status' => 404]);
        }

        exit();
    }
    public function get_payments_user()
    {
        $this->load->model('payment_model', 'payment');
        $user_id = $this->input->post('user_id');
        $obj = $this->payment->get_by_payment_user_id($user_id);
        $array = [];
        if (count($obj) > 0) {
            foreach ($obj as $item) {
                if ($item->status == 0 || $item->status == 3) {
                    array_push($array, $item);
                }
            }
        }

        if (count($array) > 0) {
            echo json_encode(['status' => 500, 'data' => $array, 'user_id' => $user_id]);
        } else {
            echo json_encode(['status' => 200]);
        }

        exit();
    }
    public function validaced()
    {
        require(APPPATH . "libraries/validar_cedula.php");

        // Crear nuevo objecto
        $validador = new validar_cedula();

        // validar CI
        if ($validador->validarCedula('1759056904')) {
            echo 'Cédula válida';
        } else {
            echo 'Cédula incorrecta: ';
        }
    }
    public function get_membresia_user_ajax()
    {
        $this->load->model('Membresia_model', 'membresia');
        $user_id = $this->session->userdata('user_id');
        if ($user_id) {
            $membresia = $this->membresia->get_by_user_id($user_id);
            if ($membresia) {
                echo json_encode(['status' => 500, 'data' => $membresia]);
            } else {
                echo json_encode(['status' => 200]);
            }
        } else {
            echo json_encode(['status' => 200]);
        }
        exit();
    }
    public function update_password_cliente()
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            $this->log_out();
            redirect('login');
        }

        $user_id = $this->session->userdata('user_id');
        $password = $this->input->post('password');
        $new_password = $this->input->post('nueva_password');
        $obj_user = $this->user->get_by_id($user_id);
        //establecer reglas de validacion
        $this->form_validation->set_rules('password', "contraseña anterior", 'required');
        $this->form_validation->set_rules('nueva_password', "nueva contraseña", 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::SUCCESS);
            redirect("perfil/page/");
        } else {
            if ($obj_user->password != md5($password)) {
                $this->response->set_message('La contraseña anterior no coincide con la alamacenada en el sistema', ResponseMessage::ERROR);
                redirect("perfil/page/");
            } else {
                $data = [
                    'password' => md5($new_password),
                ];
                $this->user->update($user_id, $data);
                $this->response->set_message('La contraseña se actualizó correctamente', ResponseMessage::SUCCESS);
                redirect("perfil/page/");
            }
        }
    }
    public function ok()
    {
        $path = 'https://www.subastanuncios.com/uploads/anuncio/5f00a7ad833e7.jpg';
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        //    $img = file_get_contents("https://www.subastanuncios.com/uploads/anuncio/5f00a7ad833e7.jpg");
        $prueba  = "<img style='width:25%' src='" . $base64 . "'>";
        //  $img = base64_encode($img);
        var_dump($prueba);
        die();
    }
    public function pago_exitoso_2()
    {
        $this->load->model('payment_model', 'payment');
        $this->payment->create_prueba(["data" => date('Y-m-d H:i:s')]);
        $datos = file_get_contents('php://input');
        //     $this->payment->create_prueba(['data' => $datos]);
        $data = json_decode($datos, true);

        $requestId = $data['requestId'];
        $reference = $data['reference'];
        // $obj =  $this->payment->get_by_reference_id("RF-1586980027-28");
        $obj =  $this->payment->get_by_reference_id($reference);

        if ($obj) {
            $this->payment->update($obj->payment_id, ['request_id' => $requestId]);
            if ($data['status']['status'] == "APPROVED") {
                $status = 1;
            } elseif ($data['status']['status'] == "PENDING") {
                $status = 3;
            } elseif ($data['status']['status'] == "REJECTED") {
                $status = 2;
            } else {
                $status = 0;
            }
            $this->payment->update($obj->payment_id, ['status' => $status, 'request_id' => $requestId]);
            if ($status == 1) {
                if ($obj->tipo == 0) { //membresia
                    $user_id = $obj->user_id;
                    $this->load->model('User_model', 'user');
                    $user_obj = $this->user->get_by_id($user_id);
                    $this->load->model('Membresia_model', 'membresia');
                    $object_membresia = $this->membresia->get_by_id($obj->id);
                    $fecha = date('Y-m-d H:i:s');
                    $fecha_fin = strtotime('+364 day', strtotime($fecha));
                    $fecha_fin = date('Y-m-d H:i:s', $fecha_fin);
                    $fecha_mes = strtotime('+30 day', strtotime($fecha));
                    $fecha_mes = date('Y-m-d', $fecha_mes);
                    $data = [
                        'user_id' => $user_id,
                        'membresia_id' => $obj->id,
                        'fecha_inicio' => $fecha,
                        'fecha_fin' => $fecha_fin,
                        'fecha_mes' => $fecha_mes,
                        'anuncios_publi' => (int) $object_membresia->cant_anuncio,
                        'qty_subastas' => (int) $object_membresia->qty_subastas,
                        'estado' => 1,
                        'mes' => 1,
                        'payment_id' => $obj->payment_id
                    ];
                    $id = $this->membresia->create_membresia_user($data);
                    if ($id) {
                        $this->load->model("Correo_model", "correo");
                        $asunto = "Membresia adquirida";
                        $motivo = 'Membresia adquirida Subasta anuncios';
                        $mensaje = "<p><img style='width:209px;heigth:44px' src='https://subastanuncios.com/assets/logo_subasta.png'></p>";
                        $mensaje .= "<h3>Membresía “" . $object_membresia->nombre . "”</h3>";
                        $mensaje .= "¡Felicitaciones! <br>Nos complace informarte que has adquirido una nueva membresía, mediante la cual tendrás acceso a los siguientes beneficios:<br>";
                        $mensaje .= "" . $object_membresia->descripcion . "<br>";
                        $mensaje .= "Tu usuario " . $user_obj->email . ", tendrá activa esta membresía hasta " . $fecha_fin . ". Para seguir gestionando las ventajas de tu membresía, recuerda renovarla antes de cumplir la anualidad.<br>";
                        $mensaje .= "Si necesitas contactar con nosotros puedes hacerlo a través del email comercial@suabastanuncios.com <br>";
                        $mensaje .= "Gracias por sumarte a nuestra plataforma<br>";
                        $mensaje .= "Saludos,<br>";
                        $mensaje .= "El equipo de SUBASTANUNCIOS";
                        $this->correo->sent($user_obj->email, $mensaje, $asunto, $motivo);
                    }
                } elseif ($obj->tipo == 1) {
                    $user_id = $obj->user_id;
                    $subasta_id = $obj->id;
                    $this->load->model('Subasta_model', 'subasta');
                    $this->load->model('Membresia_model', 'membresia');
                    $membresia = $this->membresia->get_membresia_by_user_id($user_id);
                    if ($membresia) {
                        $qty = (int) $membresia->qty_subastas;
                        if ($qty > 0) {
                            $resta = $qty - 1;
                            $this->membresia->update_membresia_user($membresia->membre_user_id, ['qty_subastas' => $resta]);
                        }
                    }
                    $data = [
                        'user_id' => $user_id,
                        'subasta_id' => $subasta_id,
                        'is_active' => 1,
                        'payment_id' => $obj->payment_id
                    ];
                    $this->subasta->create_subasta_user($data);
                } elseif ($obj->tipo == 2) {
                    $this->load->model('Anuncio_model', 'anuncio');
                    $anuncio_id = $obj->id;
                    $fecha = date('Y-m-d');
                    $fecha_fin = strtotime('+30 day', strtotime($fecha));
                    $this->anuncio->update($anuncio_id, ['destacado' => 1, 'fecha_vencimiento' => $fecha_fin, 'payment_id' => $obj->payment_id]);
                } elseif ($obj->tipo == 3) {
                    $user_id = $obj->user_id;
                    $subasta_id = $obj->id;
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
                        'payment_id' => $obj->payment_id
                    ];
                    $this->subasta->create_subasta_user($data);
                }
            }
        }
    }
    public function generar_pedido_inversa()
    {
        $this->load->model('User_model', 'user');
        $subasta_id = $this->input->post('id');
        $user_id = $this->input->post('user_id');
        $valida_user = $this->input->post('valida_user');
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $telefono = $this->input->post('telefono');
        $email = $this->input->post('email');

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
        if ($valida_user == "true") {
            $cliente = $this->user->get_by_id($user_id);
        } else {
            $cliente = ['name' => $nombre, 'surname' => $apellido, 'phone' => $telefono, 'email' => $email];
        }
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
            echo json_encode(['status' => 200]);
        } else {
            echo json_encode(['status' => 500]);
        }
        exit();
    }
}
