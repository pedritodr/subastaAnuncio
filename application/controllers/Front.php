<?php

class Front extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        //$this->load->model('User_model', 'user');
        $this->load->library(array('session'));
        // Load the library
        $this->load->library('recaptcha');
        $this->load->library('pagination');
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {
        $this->load->model('Banner_model', 'banner');
        $this->load->model('Empresa_model', 'empresa');
        $this->load->model('Cate_anuncio_model', 'cate_anuncio');
        $this->load->model('Categoria_model', 'categoria');
        $this->load->model('Subasta_model', 'subasta');
        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Pais_model', 'pais');


        $data['empresa_object'] = $this->empresa->get_by_id(1);

        $all_banners = $this->banner->get_all(); //todos los banners
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
            $item->all_subastas = $this->subasta->get_by_categoria_id($item->categoria_id);
        }



        $data['all_categorias'] = $all_categorias;
        $all_subastas = $this->subasta->get_subastas();
        $data['all_subastas'] = $all_subastas;

        // var_dump($all_categorias);die();
        $this->load_view_front('front/index', $data);
    }



    public function llamar_login()
    {
        $this->load_view_front('front/login');
    }


    public function registrar()
    {


        $this->load_view_front('front/add_cliente');
    }


    public function anuncio()
    {
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




        $this->load_view_front('front/add_anuncio', $data);
    }



    public function get_ciudad()
    { //buscar ciudad


        $this->load->model('Pais_model', 'pais');

        $pais_id = $this->input->post('pais_id');

        $all_ciudades = $this->pais->get_by_pais_id_object($pais_id);

        echo json_encode($all_ciudades);
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



        $all_anuncios = $this->anuncio->get_by_id($anuncio_id);


        $fotos_object = $this->photo_anuncio->get_by_anuncio_id($anuncio_id);


        $data['all_anuncios'] =  $all_anuncios;
        $data['fotos_object'] = $fotos_object;

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
        $subasta_user =  $this->subasta->get_subasta_user($user_id, $subasta_id);

        $puja =  $this->subasta->get_puja_alta($subasta_id);
        $data['subasta_user'] = $subasta_user;
        $data['puja'] = $puja;
        $data['all_detalle'] = $all_detalle;
        $data['foto_object'] = $foto_object;
        $data['all_categoria'] = $all_categoria;

        echo json_encode($data);
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
            $result = save_image_from_post('archivo', './uploads/photo_anuncio', time(), 750, 422.56);
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
                redirect("listado-anuncio");
            }
        } else {

            $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
            redirect("listado-anuncio");
        }
    }


    public function add_cliente()
    {

        $this->load->model('User_model', 'user');

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $phone = $this->input->post('phone');
        $repeat_password = $this->input->post('repeat_password');
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');

        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('email', translate('email_lang'), 'required|is_unique[user.email]');
        $this->form_validation->set_rules('password', translate('password_lang'), 'required|matches[repeat_password]');


        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("registrarse");
        } else { //en caso de que todo este bien
            $data_user = [
                'name' => $name,
                'email' => $email,
                'password' => md5($password),
                'phone' => $phone,
                'role_id' => 4,
                'lat' => $lat,
                'lng' => $lng

            ];
            $this->user->create($data_user);
            $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
            redirect("login");
        }
    }

    public function add_anuncio()
    {

        $this->load->model('Anuncio_model', 'anuncio');

        $titulo = $this->input->post('titulo');
        $descripcion = $this->input->post('descripcion');
        $precio = $this->input->post('precio');
        $photo = $this->input->post('photo');
        $whatsapp = $this->input->post('whatsapp');
        $subcate_id = $this->input->post('subcategoria');
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');
        $ciudad = $this->input->post('ciudad');
        $user_id = $this->session->userdata('user_id');
        $direccion = $this->input->post('pac-input');

        //establecer reglas de validacion
        $this->form_validation->set_rules('titulo', translate('titulo_anun_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("anuncios");
        } else {
            $name_file = $_FILES['archivo']['name'];

            $separado = explode('.', $name_file);


            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = save_image_from_post('archivo', './uploads/anuncio', time(), 800, 600);
                if ($result[0]) {
                    $data = [
                        'titulo' => $titulo,
                        'descripcion' => $descripcion,
                        'precio' => $precio,
                        'photo' => $result[1],
                        'whatsapp' => $whatsapp,
                        'subcate_id' => $subcate_id,
                        'is_active' => 1,
                        'lat' => $lat,
                        'lng' => $lng,
                        'ciudad_id' => $ciudad,
                        'user_id' => $user_id,
                        'direccion' => $direccion
                    ];
                    $this->anuncio->create($data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("listado-anuncio");
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("anuncios", "location", 301);
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("anuncios", "location", 301);
            }
        }
    }


    public function contacto()
    {

        $this->load_view_front('front/contact');
    }
    public function buscar_subasta()
    {

        $this->load->model('Subasta_model', 'subasta');
        $this->load->model('Categoria_model', 'category');
        $categories = $this->category->get_all();
        $data['categories'] = $categories;
        $category = $this->input->post('category');

        $subasta_palabra = $this->input->post('subasta_palabra');
        $ok = false;
        if ($category != '') {
            $contador = count($this->subasta->get_subastas_category($category));
            $ok = true;
        } elseif ($subasta_palabra != '') {
            $contador = count($this->subasta->get_subastas_palabra($subasta_palabra));
            $ok = false;
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
        if ($ok) {
            $all_subastas = $this->subasta->get_all_by_subastas_with_pagination_categoria($config['per_page'], $offset, $category);
        } else {
            $all_subastas = $this->subasta->get_all_by_subastas_with_pagination_palabra($config['per_page'], $offset, $subasta_palabra);
        }
        foreach ($all_subastas as $item) {
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

    public function subasta()
    {
        $this->load->model('Subasta_model', 'subasta');
        $this->load->model('Categoria_model', 'category');
        $categories = $this->category->get_all();
        $data['categories'] = $categories;
        /* URL a la que se desea agregar la paginación*/
        $config['base_url'] = site_url('front/subasta/');

        /*Obtiene el total de registros a paginar */

        $contador = count($this->subasta->get_subastas());
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

        $all_subastas = $this->subasta->get_all_by_subastas_with_pagination($config['per_page'], $offset);

        foreach ($all_subastas as $item) {
            $item->contador_fotos = count($this->subasta->get_by_subasta_id($item->subasta_id));

            $item->subasta_user =  $this->subasta->get_subasta_user($user_id, $item->subasta_id);

            $item->puja =  $this->subasta->get_puja_alta($item->subasta_id);
        }

        $data['all_subastas'] = $all_subastas;
        $data['resultados'] = $contador;
        if ($offset == 0) {
            $data['inicio'] = 1;
            $data['fin'] =  5;
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
    public function anuncios_index()
    {
        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Cate_anuncio_model', 'category');
        $categories = $this->category->get_all();
        foreach ($categories as $item) {
            $item->count = count($this->anuncio->get_anuncios_by_category($item->cate_anuncio_id));
        }
        $data['categories'] = $categories;
        /* URL a la que se desea agregar la paginación*/
        $config['base_url'] = site_url('front/anuncios_index/');

        /*Obtiene el total de registros a paginar */

        $contador = count($this->anuncio->get_anuncios());
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

        $all_anuncios = $this->anuncio->get_all_anuncios_with_pagination($config['per_page'], $offset);
        foreach ($all_anuncios as $item) {
            $long = strlen($item->descripcion);

            if ($long > 150) {
                $item->corta = substr($item->descripcion, 0, 150) . "...";
            } else {

                $item->corta = $item->descripcion;
            }
        }
        $data['all_anuncios'] = $all_anuncios;
        $data['resultados'] = $contador;
        if ($offset == 0) {
            $data['inicio'] = 1;
            $data['fin'] =  5;
        } else {
            $data['inicio'] = $offset + 1;
            $intervalo = 5 + $offset;
            if ($intervalo > $contador) {
                $data['fin'] = $contador;
            } else {
                $data['fin'] = $intervalo;
            }
        }

        $this->load_view_front('front/anuncios', $data);
    }

    public function buscar_anuncio($category = 0)
    {

        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Cate_anuncio_model', 'category');
        $categories = $this->category->get_all();

        foreach ($categories as $item) {
            $item->count = count($this->anuncio->get_anuncios_by_category($item->cate_anuncio_id));
        }
        $data['categories'] = $categories;

        $anuncio_palabra = $this->input->post('anuncio_palabra');
        $ok = false;
        if ($category != 0) {

            $contador = count($this->anuncio->get_anuncios_by_category($category));

            $ok = true;
        } elseif ($anuncio_palabra != '') {
            $contador = count($this->anuncio->get_anuncio_palabra($anuncio_palabra));
            $ok = false;
        }

        /* URL a la que se desea agregar la paginación*/
        $config['base_url'] = site_url('front/anuncios_index/');

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
        var_dump($page);
        die();
        $offset = !$page ? 0 : $page;

        //      $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        if ($ok) {
            $all_anuncios = $this->anuncio->get_all_anuncios_with_pagination_by_categoria($config['per_page'], $offset, $category);
            var_dump($all_anuncios);
            die();
        } else {
            $all_anuncios = $this->anuncio->get_all_anuncios_with_pagination_by_name($config['per_page'], $offset, $anuncio_palabra);
        }


        foreach ($all_anuncios as $item) {
            $long = strlen($item->descripcion);

            if ($long > 150) {
                $item->corta = substr($item->descripcion, 0, 150) . "...";
            } else {

                $item->corta = $item->descripcion;
            }
        }

        $data['all_anuncios'] = $all_anuncios;
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

        $this->load_view_front('front/anuncios', $data);
    }


    public function about()
    {

        $this->load->model('Empresa_model', 'empresa');
        $this->load->model('Membresia_model', 'membresia');


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
        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Cate_anuncio_model', 'cate_anuncio');
        $this->load->model('Pais_model', 'pais');
        $this->load->model('Membresia_model', 'membresia');
        $user_id = $this->session->userdata('user_id');


        $all_anuncios = $this->anuncio->get_all(['user_id' => $user_id]);

        $config['base_url'] = site_url('front/perfil/');

        /*Obtiene el total de registros a paginar */
        $contador = count($all_anuncios);
        $config['total_rows'] = $contador;


        /*Obtiene el numero de registros a mostrar por pagina */
        $config['per_page'] = '4';
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
        $anuncios_partes = $this->anuncio->get_all_by_anuncios_with_pagination($user_id, $config['per_page'], $offset);
        foreach ($anuncios_partes as $item) {

            $subcate_object = $this->cate_anuncio->get_by_subcate_id_object($item->subcate_id);

            $item->subcate =  $subcate_object;

            $all_ciudad = $this->pais->get_by_ciudad_id_object($item->ciudad_id);

            $item->ciudad = $all_ciudad;
        }

        $data['all_anuncios'] = $anuncios_partes;

        $data['resultados'] = $contador;
        if ($offset == 0) {
            $data['inicio'] = 1;
            $data['fin'] =  4;
        } else {
            $data['inicio'] = $offset + 1;
            $intervalo = 4 + $offset;
            if ($intervalo > $contador) {
                $data['fin'] = $contador;
            } else {
                $data['fin'] = $intervalo;
            }
        }

        $all_membresia = $this->membresia->get_by_user_id($user_id);


        $data['all_membresia'] = $all_membresia;

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
        $membresia = $this->input->post('membresia');
        $this->load->model('Membresia_model', 'membresia');
        $data = [
            'user_id' => $user_id,
            'membresia_id' => $membresia,
            'fecha' => date('Y-m-d H:i:s'),

        ];
        $this->membresia->create_membresia_user($data);
        $this->response->set_message(translate('adquirir_membresia_lang'), ResponseMessage::SUCCESS);
        redirect("perfil");
    }

    public function pagar_entrada()
    {
        $user_id = $this->session->userdata('user_id');
        $subasta_id = $this->input->post('subasta_id');
        $this->load->model('Subasta_model', 'subasta');
        $data = [
            'user_id' => $user_id,
            'subasta_id' => $subasta_id,
            'is_active' => 1
        ];
        $this->subasta->create_subasta_user($data);
        $this->response->set_message(translate('piso_pagado_lang'), ResponseMessage::SUCCESS);
        redirect("perfil");
    }

    public function pujar()
    {

        $subasta_user_id = $this->input->post('subasta_user_id');
        $valor = $this->input->post('valor');
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
}
