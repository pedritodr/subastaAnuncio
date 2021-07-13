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

        $anuncios = $this->anuncio->searchFull(null, null, null, null, 42, 0);
        shuffle($anuncios);
        $all_anuncios =  array_slice($anuncios, 0, 21);
        foreach ($all_anuncios as $item) {
            $nombre = strlen($item->titulo);
            if ($nombre > 19) {
                $item->corto = substr($item->titulo, 0, 17) . "...";
            } else {

                $item->corto = $item->titulo;
            }
        }
        $data['all_anuncios'] = $all_anuncios;
        $data['all_categorias'] = $all_categorias;
        $all_subastas = $this->subasta->get_subastas();

        $data['all_subastas'] = $all_subastas;

        /*  var_dump($all_categorias);
        die();*/
        $e = array(
            'general' => true, //description
            'og' => true,
            'twitter' => true,
            'robot' => true
        );
        $description = 'La nueva alternativa para comercializar, impulsar, comprar, vender, subastar variedad de artículos a través de nuestra plataforma online de manera práctica';
        $data_header = array($e, $title = 'Subastas | Anuncios', $desc = substr(strip_tags($description), 0, 250), $imgurl = 'https://www.subastanuncios.com/assets_front/images/logo-subasta-anuncio.png', $url = site_url());
        $this->load_view_front('front/index', $data, 0, $data_header);
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
        $e = array(
            'general' => true, //description
            'og' => true,
            'twitter' => true,
            'robot' => true
        );
        $description = 'La nueva alternativa para comercializar, impulsar, comprar, vender, subastar variedad de artículos a través de nuestra plataforma online de manera práctica';
        $data_header = array($e, $title = 'Faqs', $desc = substr(strip_tags($description), 0, 250), $imgurl = 'https://www.subastanuncios.com/assets_front/images/logo-subasta-anuncio.png', $url = site_url());
        $this->load_view_front('front/faq', $data, 0, $data_header);
    }
    public function condiciones()
    {
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
        $data['all_banners'] = $all_banners;
        $e = array(
            'general' => true, //description
            'og' => true,
            'twitter' => true,
            'robot' => true
        );
        $description = 'La nueva alternativa para comercializar, impulsar, comprar, vender, subastar variedad de artículos a través de nuestra plataforma online de manera práctica';
        $data_header = array($e, $title = 'Condiciones de uso', $desc = substr(strip_tags($description), 0, 250), $imgurl = 'https://www.subastanuncios.com/assets_front/images/logo-subasta-anuncio.png', $url = site_url());
        $this->load_view_front('front/condiciones', $data, 0, $data_header);
    }
    public function politicas()
    {
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
        $data['all_banners'] = $all_banners;
        $e = array(
            'general' => true, //description
            'og' => true,
            'twitter' => true,
            'robot' => true
        );
        $description = 'La nueva alternativa para comercializar, impulsar, comprar, vender, subastar variedad de artículos a través de nuestra plataforma online de manera práctica';
        $data_header = array($e, $title = 'Políticas', $desc = substr(strip_tags($description), 0, 250), $imgurl = 'https://www.subastanuncios.com/assets_front/images/logo-subasta-anuncio.png', $url = site_url());
        $this->load_view_front('front/politicas', $data, 0, $data_header);
    }
    public function aviso_legal()
    {
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
        $data['all_banners'] = $all_banners;
        $e = array(
            'general' => true, //description
            'og' => true,
            'twitter' => true,
            'robot' => true
        );
        $description = 'La nueva alternativa para comercializar, impulsar, comprar, vender, subastar variedad de artículos a través de nuestra plataforma online de manera práctica';
        $data_header = array($e, $title = 'Aviso Legal', $desc = substr(strip_tags($description), 0, 250), $imgurl = 'https://www.subastanuncios.com/assets_front/images/logo-subasta-anuncio.png', $url = site_url());
        $this->load_view_front('front/aviso_legal', $data, 0, $data_header);
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
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
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
        ini_set('max_execution_time', '0');
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            echo json_encode(['status' => 500]);
            exit();
        }
        if ($this->session->userdata('role_id')) {
            if (!in_array($this->session->userdata('role_id'), [1, 2])) {
                echo json_encode(['status' => 404]);
                exit();
            }
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
        $photo = json_decode($_POST['photo']);
        $user_id = $this->session->userdata('user_id');
        $direccion = $this->input->post('pac_input');
        $anuncio_id = $this->input->post('anuncioId');
        $city = $this->input->post('city_main');
        $url = $this->input->post('url');
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
        define('UPLOAD_DIR', './uploads/anuncio/');
        $main_photo = false;
        $new_imagen = null;
        if ($photo->foto_anuncio_id == null) {
            $img =  $photo->imagen;
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $file = UPLOAD_DIR . uniqid() . '.jpg';
            $success = file_put_contents($file, $data);
            $main_photo = true;
            $new_imagen = $file;
        } else {
            if ($anuncio_id != $photo->foto_anuncio_id) {
                $main_photo = true;
                $obj = $this->photo_anuncio->get_by_id($photo->foto_anuncio_id);
                if ($obj) {
                    $this->photo_anuncio->delete($photo->foto_anuncio_id);
                    $new_imagen = $photo->id;
                }
            }
        }
        if ($main_photo) {
            if ($new_imagen) {
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
                    'photo' => $new_imagen,
                    'url' => $url
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
                    'url' => $url
                ];
            }
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
                'url' => $url
            ];
        }
        $row = $this->anuncio->update($anuncio_id, $datos);
        if ($row >= 0) {
            $this->session->set_userdata('validando', 2);
            echo json_encode(['status' => 200, 'id' => $anuncio_id]);
            exit();
        }
    }
    public function update_photo_anuncio()
    {
        ini_set('max_execution_time', '0');
        define('UPLOAD_DIR', './uploads/anuncio/');
        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Photo_anuncio_model', 'photo_anuncio');
        $id = $this->input->post('id');
        $photos = json_decode($_POST['photos']);
        if (count($photos) > 0) {
            $salva = [];
            $all_fotos_ads = $this->photo_anuncio->get_by_anuncio_id($id);
            foreach ($photos as $item) {
                if ($item->foto_anuncio_id == null) {
                    $img =  $item->imagen;
                    $img = str_replace('data:image/png;base64,', '', $img);
                    $img = str_replace(' ', '+', $img);
                    $data = base64_decode($img);
                    $file = UPLOAD_DIR . uniqid() . '.jpg';
                    // $image = uniqid() . '.jpg';
                    $success = file_put_contents($file, $data);
                    $creado =  $this->photo_anuncio->create(['photo_anuncio' => $file, 'anuncio_id' => $id]);
                } else {
                    $salva[] = $item;
                }
            }
            foreach ($all_fotos_ads as $item) {
                $encontrado = false;
                foreach ($salva as $s) {
                    if ($s->foto_anuncio_id == $item->photo_anuncio_id) {
                        $encontrado = true;
                    }
                }
                if (!$encontrado) {
                    $this->photo_anuncio->delete($item->photo_anuncio_id);
                    if (file_exists($item->photo_anuncio)) {
                        unlink($item->photo_anuncio);
                    }
                }
            }
            echo json_encode(['status' => 200]);
            exit();
        } else {
            $this->photo_anuncio->delete_fotos($id);
            echo json_encode(['status' => 200]);
            exit();
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

        if ($all_anuncios) {
            $views = $all_anuncios->views + 1;
            $this->anuncio->update($anuncio_id, ['views' =>  $views]);
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
            $e = array(
                'general' => true, //description
                'og' => true,
                'twitter' => true,
                'robot' => true
            );
            $data_header = array($e, $title = $all_anuncios->titulo, $desc = substr(strip_tags($all_anuncios->descripcion), 0, 250), $imgurl = base_url($all_anuncios->anuncio_photo), $url =  base_url(strtolower('anuncio/' . strtolower(seo_url($all_anuncios->titulo))) . $all_anuncios->anuncio_id));
            $this->load_view_front('front/detalle_anuncio', $data, 0, $data_header);
        } else {
            show_404();
        }
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
        $this->load->model('Tree_node_model', 'tree_node');
        $name = $this->input->post('name');
        $apellido = $this->input->post('surname');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $phone = $this->input->post('phone');
        $tipo_documento = $this->input->post('tipo_documento');
        $nro_documento = $this->input->post('nro_documento');
        $referidor = trim($this->input->post('referidor'));
        $validEmail = $this->user->get_user_by_email($email);
        if ($validEmail) {
            echo json_encode(['status' => 500, 'msj' => 'El email ya esta registrado.']);
            exit();
        }
        if ($tipo_documento == 1) {
            // Crear nuevo objecto
            $validador = new validar_cedula();
            // validar CI
            if ($validador->validarCedula($nro_documento)) {
                //valida
            } else {
                echo json_encode(['status' => 500, 'msj' => 'El cédula introducida no es correcta.']);
                exit();
            }
        }
        $emailAdmid = '';
        if (ENVIRONMENT == "development") {
            $emailAdmid = 'pedroduran014@gmail.com';
        }
        if (ENVIRONMENT == "production") {
            $emailAdmid = 'comercial@subastanuncios.com';
        }
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
            'tipo_documento' => $tipo_documento,
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
        if ($user_id > 0) {
            if ($referidor != '') {
                $response  = $this->user->get_user_by_email_active($referidor);
                if ($response) {
                    $node = $this->tree_node->get_node_row_by_user_id($response->user_id);
                    $data_node = [
                        'membre_user_id' => 0,
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
                    $this->user->update($user_id, ['codigo_seguridad' => $codigo_seguridad, 'fecha_vencimiento_codigo' => $fecha_vencimiento, 'parent' => $response->user_id]);
                } else {
                    $admin  = $this->user->get_user_by_email_active($emailAdmid);
                    if ($admin) {
                        $node = $this->tree_node->get_node_row_by_user_id($admin->user_id);
                        $data_node = [
                            'membre_user_id' => 0,
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
                        $this->user->update($user_id, ['codigo_seguridad' => $codigo_seguridad, 'fecha_vencimiento_codigo' => $fecha_vencimiento, 'parent' => $admin->user_id]);
                    } else {
                        $this->user->update($user_id, ['codigo_seguridad' => $codigo_seguridad, 'fecha_vencimiento_codigo' => $fecha_vencimiento]);
                    }
                }
            } else {
                $admin  = $this->user->get_user_by_email_active($emailAdmid);
                if ($admin) {
                    $node = $this->tree_node->get_node_row_by_user_id($admin->user_id);
                    $data_node = [
                        'membre_user_id' => 0,
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
                    $this->user->update($user_id, ['codigo_seguridad' => $codigo_seguridad, 'fecha_vencimiento_codigo' => $fecha_vencimiento, 'parent' => $admin->user_id]);
                } else {
                    $this->user->update($user_id, ['codigo_seguridad' => $codigo_seguridad, 'fecha_vencimiento_codigo' => $fecha_vencimiento]);
                }
            }
        }

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
        echo json_encode(['status' => 200, 'msj' => 'Solo te queda un paso para completar tu registro']);
        exit();
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
        ini_set('max_execution_time', '0');
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            echo json_encode(['status' => 500]);
            exit();
        }
        if ($this->session->userdata('role_id')) {
            if (!in_array($this->session->userdata('role_id'), [1, 2])) {
                echo json_encode(['status' => 404]);
                exit();
            }
        }
        define('UPLOAD_DIR', './uploads/anuncio/');
        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Membresia_model', 'membresia');
        $this->load->model('Pais_model', 'pais');
        $titulo = $this->input->post('titulo');
        $descripcion = $this->input->post('descripcion');
        $precio = $this->input->post('precio');
        $photo = json_decode($_POST['photo']);
        $whatsapp = $this->input->post('whatsapp');
        $subcate_id = $this->input->post('subcategoria');
        $lat = $this->input->post('lat');
        $lng = $this->input->post('lng');
        $user_id = $this->session->userdata('user_id');
        $email = $this->session->userdata('email');
        $direccion = $this->input->post('pac_input');
        $city = $this->input->post('city_main');
        $url = $this->input->post('url');
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
        $fecha_fin = strtotime('+150 day', strtotime($fecha));
        $fecha_fin = date('Y-m-d', $fecha_fin);
        $img =  $photo->imagen;
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = UPLOAD_DIR . uniqid() . '.jpg';
        // $image = uniqid() . '.jpg';
        $success = file_put_contents($file, $data);
        $data_ads = [
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'photo' => $file,
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
            'fecha_vencimiento' => $fecha_fin,
            'url' => $url
        ];
        $id = false;
        if ($membresia) {
            $id =  $this->anuncio->create($data_ads);
            if ($id) {
                if ((int) $membresia->anuncios_publi > 0) {
                    $qty_anuncios = (int) $membresia->anuncios_publi - 1;
                    $this->membresia->update_membresia_user($membresia->membre_user_id, ['anuncios_publi' => $qty_anuncios]);
                    $this->anuncio->update($id, ['destacado' => 1]);
                }
            }
            $this->load->model('Tree_node_model', 'tree_node');
            $userNode = $this->tree_node->get_node_header_by_user_id($user_id);
            if ($userNode) {
                $points = (float)$userNode->points + 20;
                $points_ads = (float)$userNode->points_ads + 20;
                if ($userNode->position == 0) {
                    $childremsRight = $this->tree_node->get_all_children($userNode->tree_node_id, 0);
                    if (count($childremsRight) > 0) {
                        $pointsRight = (float)$userNode->points_right + $points;
                        $totalPointsRight = (float)$userNode->total_point_right + $points;
                        $data_node = [
                            'points' => $points,
                            'points_ads' => $points_ads,
                            'points_right' => $pointsRight,
                            'total_point_right' => $totalPointsRight
                        ];
                        $this->tree_node->update($userNode->tree_node_id, $data_node);
                    } else {
                        $data = [
                            'points_ads' => $points_ads
                        ];
                        $this->tree_node->update($userNode->tree_node_id, $data);
                    }
                } else {
                    $childremsLeft = $this->tree_node->get_all_children($userNode->tree_node_id, 1);
                    if (count($childremsLeft) > 0) {
                        $pointsLeft = (float)$userNode->points_left + $points;
                        $totalPointsLeft = (float)$userNode->total_points_left + $points;
                        $data_node = [
                            'points' => $points,
                            'points_ads' => $points_ads,
                            'points_left' => $pointsLeft,
                            'total_points_left' => $totalPointsLeft
                        ];
                        $this->tree_node->update($userNode->tree_node_id, $data_node);
                    } else {
                        $data_node = [
                            'points_ads' => $points_ads
                        ];
                        $this->tree_node->update($userNode->tree_node_id, $data_node);
                    }
                }

                $parent = $userNode->parent;
                $poinsTree = 20;
                do {
                    if ($parent == 0) {
                        $continue = false;
                    } else {
                        $nodeTemp = $this->tree_node->get_node_padre_by_id($parent);
                        $parent = $nodeTemp->parent;
                        if ($nodeTemp->position == 0) {
                            $childremsRight = $this->tree_node->get_all_children($nodeTemp->tree_node_id, 0);
                            if (count($childremsRight) > 0) {
                                $pointsRight = (float)$nodeTemp->points_right + $poinsTree;
                                $totalPointsRight = (float)$nodeTemp->total_point_right + $poinsTree;
                                $data_node = [
                                    'points_right' => $pointsRight,
                                    'total_point_right' => $totalPointsRight
                                ];
                                $this->tree_node->update($nodeTemp->tree_node_id, $data_node);
                            }
                        } else {
                            $childremsLeft = $this->tree_node->get_all_children($nodeTemp->tree_node_id, 1);
                            if (count($childremsLeft) > 0) {
                                $pointsLeft = (float)$nodeTemp->points_left + $poinsTree;
                                $totalPointsLeft = (float)$nodeTemp->total_points_left + $poinsTree;
                                $data_node = [
                                    'points_left' => $pointsLeft,
                                    'total_points_left' => $totalPointsLeft
                                ];
                                $this->tree_node->update($nodeTemp->tree_node_id, $data_node);
                            }
                        }
                        $continue = true;
                    }
                } while ($continue);
            }
        } else {
            $id = $this->anuncio->create($data_ads);
        }
        if ($id) {
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
            $this->session->set_userdata('validando', 2);
            echo json_encode(['status' => 200, 'id' => $id]);
            exit();
        }
        // $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);

        // redirect("perfil/page");

    }

    public function add_photo_anuncio()
    {
        ini_set('max_execution_time', '0');
        define('UPLOAD_DIR', './uploads/anuncio/');
        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Photo_anuncio_model', 'photo_anuncio');
        $id = $this->input->post('id');
        $photos = json_decode($_POST['photos']);
        if (count($photos) > 0) {
            foreach ($photos as $item) {
                $img =  $item->imagen;
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $file = UPLOAD_DIR . uniqid() . '.jpg';
                // $image = uniqid() . '.jpg';
                $success = file_put_contents($file, $data);
                $creado =  $this->photo_anuncio->create(['photo_anuncio' => $file, 'anuncio_id' => $id]);
            }
            echo json_encode(['status' => 200]);
            exit();
        } else {
            echo json_encode(['status' => 200]);
            exit();
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
        $fecha_fin = strtotime('+150 day', strtotime($fecha));
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
        $this->load->model('Banner_model', 'banner');
        $this->load->model('Pais_model', 'pais');
        $all_banners = $this->banner->get_all(['menu_id' => 3]); //todos los banners
        $data['all_banners'] = $all_banners;
        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Cate_anuncio_model', 'category');

        $search = $this->input->get('search');
        $category = (int)$this->input->get('category');
        if ($category == 0) {
            $category = null;
        }
        $subcategory = (int)$this->input->get('subCategory');
        if ($subcategory == 0) {
            $subcategory = null;
        }
        $city = (int)$this->input->get('city');
        $data['city'] = $city;
        if ($city == 0) {
            $city = null;
        }

        $categories = $this->category->get_all();

        foreach ($categories as $item) {
            $item->subCategories = $this->category->get_by_Cate_anuncio_id($item->cate_anuncio_id);
            $item->count = count($this->anuncio->get_anuncios_by_category($item->cate_anuncio_id));
        }

        $data['categories'] = $categories;


        $contador = count($this->anuncio->searchFull($search, $city, $subcategory, $category, null, null));

        //   $all_anuncios = $this->anuncio->get_all_anuncios_with_pagination(21, 0);
        $all_anuncios = $this->anuncio->searchFull($search, $city, $subcategory, $category, 21, 0);

        foreach ($all_anuncios as $item) {

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
        $data['count_ads'] = $contador;

        $all_ciudad = $this->pais->get_by_pais_id_object(4);

        $data['all_ciudad'] = $all_ciudad;


        $this->load_view_front('front/anuncios', $data);
    }
    public function load_ads()
    {
        try {
            $this->load->model('Anuncio_model', 'anuncio');
            $offset = (int)$this->input->post('offset');
            $search = $this->input->post('textSearch');
            $city = (int)$this->input->post('cityId');
            $subcategory = (int)$this->input->post('subcategory');
            $category = (int)$this->input->post('category');
            $all_anuncios = $this->anuncio->searchFull($search, $city, $subcategory, $category, 21, $offset);

            foreach ($all_anuncios as $item) {
                if (!file_exists($item->anuncio_photo)) {
                    $item->anuncio_photo = null;
                }
                $nombre = strlen($item->titulo);
                if ($nombre > 54) {
                    $item->corto = substr($item->titulo, 0, 54) . "...";
                } else {

                    $item->corto = $item->titulo;
                }
            }
            echo json_encode(['status' => 200, 'msj' => 'correcto', 'data' => $all_anuncios]);
            exit();
        } catch (\Throwable $th) {
            echo json_encode(['status' => 404, 'msj' => 'Ocurrió un problema']);
            exit();
        }
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

        $all_membresia = $this->membresia->get_all(['is_delete' => 0]);

        $data_object['all_membresia'] = $all_membresia;
        $this->load->model('Wallet_model', 'wallet');
        $wallet = $this->wallet->get_wallet_by_user_id($user_id);
        $data['empresa_object'] = $empresa_object;
        $data_object['wallet'] = json_encode($wallet);

        $this->load_view_front('front/membresia', $data_object);
    }

    public function financiamiento()
    {

        $this->load->model('Empresa_model', 'empresa');
        //    $this->load->model('Financiamiento_model', 'financiamiento');
        $this->load->model('Banner_model', 'banner');
        $all_banners = $this->banner->get_all(['menu_id' => 3]); //todos los banners
        $data_object['all_banners'] = $all_banners;
        if ($this->session->flashdata('mensaje')) {
            $data_object['mensaje'] = $this->session->flashdata('mensaje');
        } else {
            $data_object['mensaje'] = "solicitud";
        }
        $e = array(
            'general' => true, //description
            'og' => true,
            'twitter' => true,
            'robot' => true
        );
        $description = 'La nueva alternativa para comercializar, impulsar, comprar, vender, subastar variedad de artículos a través de nuestra plataforma online de manera práctica';
        $data_header = array($e, $title = 'Financiamiennto', $desc = substr(strip_tags($description), 0, 250), $imgurl = 'https://www.subastanuncios.com/assets_front/images/logo-subasta-anuncio.png', $url = site_url());
        $this->load_view_front('front/financiamiento', $data_object, 0, $data_header);
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

        /*Obtiene el total de registros a paginar */
        $contador = count($all_anuncios);

        // $anuncios_partes = $this->anuncio->get_all_by_anuncios_with_pagination($user_id, 100, 0);

        foreach ($all_anuncios as $item) {
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

        $data['all_anuncios'] = $all_anuncios;

        $data['resultados'] = $contador;

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
        $user = $this->user->get_by_id($user_id);
        if ($user) {
            $user->parent = $this->user->get_by_id($user->parent);
        }
        $this->load->model('Wallet_model', 'wallet');
        $this->load->model('Transaction_model', 'transaction');
        $this->load->model('Bank_data_model', 'bank_data');
        $bank_data = $this->bank_data->get_by_user_id($user_id);
        $wallet = $this->wallet->get_wallet_by_user_id($user_id);
        if ($wallet) {
            $transacciones = $this->transaction->get_all_transaccione_by_id($wallet->wallet_id);
            if ($transacciones) {
                foreach ($transacciones as $item) {
                    $item->user_send = $this->wallet->get_wallet_by_id($item->wallet_send);
                    $item->user_receives = $this->wallet->get_wallet_by_id($item->wallet_receives);
                }
            }
        } else {
            $transacciones = [];
        }
        $this->load->model('Tree_node_model', 'tree');
        $node = $this->tree->get_node_header_by_user_id($user_id);

        if ($node) {
            $data['team_left']  = count($this->tree->get_all_children($node->tree_node_id, 1));
            $data['team_right']  = count($this->tree->get_all_children($node->tree_node_id, 0));
        } else {
            $data['team_left']  = 0;
            $data['team_right']  = 0;
        }
        $data['contador_anuncios'] = $contador;
        $data['all_ciudad'] = $all_ciudad;
        $data['city'] = $city;
        $data['all_membresia'] = $all_membresia;
        $data['user_data'] = $user;
        $data['mis_subastas_inversas'] = $subastas_inversas;
        $data['mis_subastas_directas'] = $mis_subastas;
        $data['user_membresia'] = $user_membresia;
        $data['wallet'] = $wallet;
        if ($wallet) {
            $data['balance'] = (float)$wallet->balance;
        } else {
            $data['balance'] = 0;
        }
        $data['transacciones'] = $transacciones;
        $data['bank_data'] = $bank_data;
        $data['node'] = $node;
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

    public function solicitar_financiamiento()
    {

        $tipo = $this->input->post('tipo');
        $monto = $this->input->post('monto');
        $entrada = $this->input->post('entrada');
        $nombres = $this->input->post('nombres');
        $apellidos = $this->input->post('apellidos');
        $cedula = $this->input->post('cedula');
        $telefono = $this->input->post('telefono');
        $email = $this->input->post('email');
        $estado_civil = $this->input->post('estado_civil');
        $datos_conyuge = $this->input->post('datos_conyuge');
        $datos_laborales = $this->input->post('datos_laborales');
        $fecha_nacimiento = $this->input->post('fecha_nacimiento');
        $ingreso = $this->input->post('ingreso');
        $gasto = $this->input->post('gasto');
        $tipo_vivienda = $this->input->post('tipo_vivienda');
        $tipo_inmobiliario = $this->input->post('tipo_inmobiliario');
        $destino_credito = $this->input->post('destino_credito');
        $tipo_auto = $this->input->post('tipo_auto');
        //establecer reglas de validacion
        if ($tipo == 1 || $tipo == 3) {
            $this->form_validation->set_rules('entrada', "Entrada", 'required');
            $this->form_validation->set_rules('monto', "Monto", 'required');
        } else {
            $this->form_validation->set_rules('monto', "Monto", 'required');
            $this->form_validation->set_rules('destino_credito', "Destino del crédito", 'required');
        }
        $this->form_validation->set_rules('nombres', "Nombres", 'required');
        $this->form_validation->set_rules('apellidos', "Apellidos", 'required');
        $this->form_validation->set_rules('cedula', "Cédula", 'required');
        $this->form_validation->set_rules('telefono', "Teléfono", 'required');
        $this->form_validation->set_rules('email', "Correo de contacto", 'required');
        $this->form_validation->set_rules('fecha_nacimiento', "Fecha de nacimiento", 'required');
        $this->form_validation->set_rules('ingreso', "Ingresos", 'required');
        $this->form_validation->set_rules('gasto', "Gastos", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("financiamientos");
        } else {
            $this->load->model("Financiamiento_model", "financiamiento");
            $data = [
                'tipo' => $tipo,
                'monto' => $monto,
                'entrada' => $entrada,
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'cedula' => $cedula,
                'telefono' => $telefono,
                'email' => $email,
                'estado_civil' => $estado_civil,
                'datos_laborales' => $datos_laborales,
                'fecha_nacimiento' => $fecha_nacimiento,
                'tipo_inmobiliario' => $tipo_inmobiliario,
                'gasto' => $gasto,
                'ingreso' => $ingreso,
                'tipo_vivienda' => $tipo_vivienda,
                'tipo_auto' => $tipo_auto,
                'datos_conyuge' => $datos_conyuge,
                'destino_credito' => $destino_credito,
                'fecha_creacion' => date("Y-m-d H:i:s"),
            ];

            $id = $this->financiamiento->create($data);
            $emails = [$email, 'info@subastanuncio.com'];
            $fecha = date('Y-m-d H:i:s');
            if ($id) {
                $this->load->model("Correo_model", "correo");
                $asunto = "Solicitud de crédito";
                $motivo = 'Solicitud de crédito Subasta anuncios';
                $mensaje = "<p><img style='width:209px;heigth:44px' src='https://subastanuncios.com/assets/logo_subasta.png'></p>";
                $mensaje .= "¡Felicitaciones! <br>Nos complace informarte que tu solicitud de crédito está en proceso brevemente los administradores se comunicaran con usted.<br>";
                $mensaje .= "Si necesitas contactar con nosotros puedes hacerlo a través del email comercial@suabastanuncios.com <br>";
                $mensaje .= "Saludos,<br>";
                $mensaje .= "El equipo de SUBASTANUNCIOS";
                $this->correo->sent($emails, $mensaje, $asunto, $motivo);
            }
            $msj = 'La solicitud de crédito fue creada correctamente';
            $this->session->set_flashdata('mensaje', $msj);
            $this->response->set_message("La solicitud de crédito fue creada correctamente", ResponseMessage::SUCCESS);
            redirect("financiamientos");
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
        $duracion = '+' . $object_membresia->duracion . ' day';
        $fecha_fin = strtotime($duracion, strtotime($fecha));
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
        if (ENVIRONMENT == 'development') {
            $login = '6dd79d14d110adedc41f3fbab8e58461';
            $secretkey = 'h61ByK5IO930k2T8';
            $url = 'https://test.placetopay.ec/redirection/api/session';
        } else {
            $login = $payment->login;
            $secretkey = $payment->secret_key;
            $url = $payment->end_ponit . 'api/session';
        }

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
                    $this->load->model('Wallet_model', 'wallet');
                    $this->load->model('Transaction_model', 'transaction');
                    $this->load->model('Tree_node_model', 'tree_node');
                    $user_obj = $this->user->get_by_id($user_id);
                    $this->load->model('Membresia_model', 'membresia');
                    $object_membresia = $this->membresia->get_by_id($obj->id);
                    $nodeTree = $this->tree_node->get_node_renovate_by_user_id($user_id);
                    if (!$nodeTree) {
                        $fecha = date('Y-m-d H:i:s');
                        if ($user_obj->parent != 0) {
                            $wallet_parent = $this->wallet->get_wallet_by_user_id($user_obj->parent);
                            $amount = (float)$object_membresia->precio * 0.20;
                            $nodeParent = $this->tree_node->get_node_renovate_by_user_id($user_obj->parent);
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
                                    'user_id' => $user_obj->parent,
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

                        $duracion = '+' . $object_membresia->duracion . ' day';
                        $fecha_fin = strtotime($duracion, strtotime($fecha));
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
                            if ($user_obj->parent == 0) {
                                $data_node = [
                                    'membre_user_id' => $id,
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
                                $node_parent = $this->tree_node->get_node_by_user($user_obj->user_id);
                                if ($node_parent) {
                                    $parent = $node_parent->parent;
                                    $points = round($object_membresia->precio * 0.7);
                                    do {
                                        if ($parent == 0) {
                                            $continue = false;
                                        } else {
                                            $nodeTemp = $this->tree_node->get_node_padre_by_id($parent);
                                            $parent = $nodeTemp->parent;
                                            if ($nodeTemp->position == 0) {
                                                $childremsRight = $this->tree_node->get_all_children($nodeTemp->tree_node_id, 0);
                                                if (count($childremsRight) > 0) {
                                                    $pointsRight = (float)$nodeTemp->points_right + $points;
                                                    $TotalPointsRight = (float)$nodeTemp->total_point_right + $points;
                                                    $data_node = [
                                                        'points_right' => $pointsRight,
                                                        'total_point_right' => $TotalPointsRight
                                                    ];
                                                    $this->tree_node->update($nodeTemp->tree_node_id, $data_node);
                                                }
                                            } else {
                                                $childremsLeft = $this->tree_node->get_all_children($nodeTemp->tree_node_id, 1);
                                                if (count($childremsLeft) > 0) {
                                                    $pointsLeft = (float)$nodeTemp->points_left + $points;
                                                    $TotalPointsLeft = (float)$nodeTemp->total_points_left + $points;
                                                    $data_node = [
                                                        'points_left' => $pointsLeft,
                                                        'total_points_left' => $TotalPointsLeft
                                                    ];
                                                    $this->tree_node->update($nodeTemp->tree_node_id, $data_node);
                                                }
                                            }
                                            $continue = true;
                                        }
                                    } while ($continue);

                                    $data_node = [
                                        'membre_user_id' => $id,
                                        'is_active' => 1,
                                        'date_active' => $fecha,
                                        'active' => 1
                                    ];
                                    $this->tree_node->update($node_parent->tree_node_id, $data_node);
                                } else {
                                    $data_node = [
                                        'membre_user_id' => $id,
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
                    } else {
                        $fecha = date('Y-m-d H:i:s');
                        $duracion = '+' . $object_membresia->duracion . ' day';
                        $fecha_fin = strtotime($duracion, strtotime($fecha));
                        $fecha_fin = date('Y-m-d H:i:s', $fecha_fin);
                        $fecha_mes = strtotime('+30 day', strtotime($fecha));
                        $fecha_mes = date('Y-m-d', $fecha_mes);
                        $dataMembership = [
                            'fecha_inicio' => $fecha,
                            'fecha_fin' => $fecha_fin,
                            'fecha_mes' => $fecha_mes,
                            'anuncios_publi' => (int) $object_membresia->cant_anuncio,
                            'qty_subastas' => (int) $object_membresia->qty_subastas,
                            'estado' => 1,
                            'mes' => 1
                        ];
                        $this->membresia->update_membresia_user($nodeTree->membre_user_id, $dataMembership);
                        $dataNode = [
                            'is_active' => 1,
                            'active' => 1,
                            'date_active' => $fecha,
                            'points' => 0,
                            'is_culminated' => 0,
                            'points_ads' => 0,
                            'benefit' => 0,
                        ];
                        $this->tree_node->update($nodeTree->tree_node_id, $dataNode);
                        //repartir puntos
                        $node_parent = $this->tree_node->get_node_by_user($user_id);
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
                                    $continue = true;
                                }
                            } while ($continue);
                            $this->tree_node->update($node_parent->tree_node_id, $data_node);
                        }
                        //comision
                        $wallet_parent = $this->wallet->get_wallet_by_user_id($user_obj->parent);
                        $amount = (float)$object_membresia->precio * 0.20;
                        $nodeParent = $this->tree_node->get_node_renovate_by_user_id($user_obj->parent);
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
                                'user_id' => $user_obj->parent,
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
                    $fecha_fin = strtotime('+150 day', strtotime($fecha));
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
                    $this->load->model('Wallet_model', 'wallet');
                    $this->load->model('Transaction_model', 'transaction');
                    $this->load->model('Tree_node_model', 'tree_node');
                    $user_obj = $this->user->get_by_id($user_id);
                    $this->load->model('Membresia_model', 'membresia');
                    $object_membresia = $this->membresia->get_by_id($obj->id);
                    $nodeTree = $this->tree_node->get_node_renovate_by_user_id($user_id);
                    if (!$nodeTree) {
                        $fecha = date('Y-m-d H:i:s');
                        if ($user_obj->parent != 0) {
                            $wallet_parent = $this->wallet->get_wallet_by_user_id($user_obj->parent);
                            $amount = (float)$object_membresia->precio * 0.20;
                            $nodeParent = $this->tree_node->get_node_renovate_by_user_id($user_obj->parent);
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
                                    'user_id' => $user_obj->parent,
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

                        $duracion = '+' . $object_membresia->duracion . ' day';
                        $fecha_fin = strtotime($duracion, strtotime($fecha));
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
                            if ($user_obj->parent == 0) {
                                $data_node = [
                                    'membre_user_id' => $id,
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
                                $node_parent = $this->tree_node->get_node_by_user($user_obj->user_id);
                                if ($node_parent) {
                                    $parent = $node_parent->parent;
                                    $points = round($object_membresia->precio * 0.7);
                                    do {
                                        if ($parent == 0) {
                                            $continue = false;
                                        } else {
                                            $nodeTemp = $this->tree_node->get_node_padre_by_id($parent);
                                            $parent = $nodeTemp->parent;
                                            if ($nodeTemp->position == 0) {
                                                $childremsRight = $this->tree_node->get_all_children($nodeTemp->tree_node_id, 0);
                                                if (count($childremsRight) > 0) {
                                                    $pointsRight = (float)$nodeTemp->points_right + $points;
                                                    $TotalPointsRight = (float)$nodeTemp->total_point_right + $points;
                                                    $data_node = [
                                                        'points_right' => $pointsRight,
                                                        'total_point_right' => $TotalPointsRight
                                                    ];
                                                    $this->tree_node->update($nodeTemp->tree_node_id, $data_node);
                                                }
                                            } else {
                                                $childremsLeft = $this->tree_node->get_all_children($nodeTemp->tree_node_id, 1);
                                                if (count($childremsLeft) > 0) {
                                                    $pointsLeft = (float)$nodeTemp->points_left + $points;
                                                    $TotalPointsLeft = (float)$nodeTemp->total_points_left + $points;
                                                    $data_node = [
                                                        'points_left' => $pointsLeft,
                                                        'total_points_left' => $TotalPointsLeft
                                                    ];
                                                    $this->tree_node->update($nodeTemp->tree_node_id, $data_node);
                                                }
                                            }
                                            $continue = true;
                                        }
                                    } while ($continue);

                                    $data_node = [
                                        'membre_user_id' => $id,
                                        'is_active' => 1,
                                        'date_active' => $fecha,
                                        'active' => 1
                                    ];
                                    $this->tree_node->update($node_parent->tree_node_id, $data_node);
                                } else {
                                    $data_node = [
                                        'membre_user_id' => $id,
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
                    } else {
                        $fecha = date('Y-m-d H:i:s');
                        $duracion = '+' . $object_membresia->duracion . ' day';
                        $fecha_fin = strtotime($duracion, strtotime($fecha));
                        $fecha_fin = date('Y-m-d H:i:s', $fecha_fin);
                        $fecha_mes = strtotime('+30 day', strtotime($fecha));
                        $fecha_mes = date('Y-m-d', $fecha_mes);
                        $dataMembership = [
                            'fecha_inicio' => $fecha,
                            'fecha_fin' => $fecha_fin,
                            'fecha_mes' => $fecha_mes,
                            'anuncios_publi' => (int) $object_membresia->cant_anuncio,
                            'qty_subastas' => (int) $object_membresia->qty_subastas,
                            'estado' => 1,
                            'mes' => 1
                        ];
                        $this->membresia->update_membresia_user($nodeTree->membre_user_id, $dataMembership);
                        $dataNode = [
                            'is_active' => 1,
                            'active' => 1,
                            'date_active' => $fecha,
                            'points' => 0,
                            'is_culminated' => 0,
                            'points_ads' => 0,
                            'benefit' => 0,
                        ];
                        $this->tree_node->update($nodeTree->tree_node_id, $dataNode);
                        //repartir puntos
                        $node_parent = $this->tree_node->get_node_by_user($user_id);
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
                                    $continue = true;
                                }
                            } while ($continue);
                            $this->tree_node->update($node_parent->tree_node_id, $data_node);
                        }
                        //comision
                        $wallet_parent = $this->wallet->get_wallet_by_user_id($user_obj->parent);
                        $amount = (float)$object_membresia->precio * 0.20;
                        $nodeParent = $this->tree_node->get_node_renovate_by_user_id($user_obj->parent);
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
                                'user_id' => $user_obj->parent,
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
                    $fecha_fin = strtotime('+150 day', strtotime($fecha));
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

    public function referrer($email = "")
    {
        $email = base64_decode($email);
        $this->load->model('Banner_model', 'banner');
        $this->load->model('User_model', 'user');
        $all_banners = $this->banner->get_all(['menu_id' => 1]); //todos los banners
        $user = $this->user->get_user_by_email_active($email);
        $data['user'] = $user;
        $data['all_banners'] = $all_banners;

        $this->load_view_front('front/add_cliente', $data);
    }
    public function cargar_arbol_afiliados()
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            echo json_encode(['status' => 500, 'msg' => "No tiene permiso para realizar esta tarea"]);
            die();
        }
        $this->load->model('Tree_node_model', 'tree');
        $user_id = $this->session->userdata('user_id');
        $lista_arbol_left = [];
        $lista_arbol_right = [];
        $firstUser = $this->tree->get_node_header_by_user_id($user_id);
        if ($firstUser) {
            $lista_arbol_left[] = $firstUser;
            $lista_arbol_right[] = $firstUser;
            $childremsLeft = $this->tree->get_all_children($firstUser->tree_node_id, 1);
            $childremsRight = $this->tree->get_all_children($firstUser->tree_node_id, 0);
            $resultLeft = array_merge($lista_arbol_left, $childremsLeft);
            $resultRight = array_merge($lista_arbol_left, $childremsRight);
            echo json_encode(['status' => 200, 'lista_left' => $resultLeft, 'lista_right' => $resultRight]);
        } else {
            echo json_encode(['status' => 200, 'lista_left' => [], 'lista_right' => []]);
        }
        exit();
    }
    public function update_bank_data()
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            echo json_encode(['status' => 500, 'msg' => "No tiene permiso para realizar esta tarea"]);
            exit();
        }
        $this->load->model('Bank_data_model', 'bank_data');
        $bankName = $this->input->post('bankName');
        $numberAcount = $this->input->post('numberAcount');
        $typeAcount = $this->input->post('typeAccount');
        $nameTitular = $this->input->post('nameTitular');
        $emailContact = $this->input->post('emailContact');
        $phoneContact = $this->input->post('phoneContact');
        $user_id = $this->session->userdata('user_id');
        $bank_data = $this->bank_data->get_by_user_id($user_id);
        if ($bank_data) {
            $data = [
                'name_bank' => $bankName,
                'number_account' => $numberAcount,
                'type_account' => $typeAcount,
                'name_titular' => $nameTitular,
                'number_id' => $numberAcount,
                'email' => $emailContact,
                'phone' => $phoneContact
            ];
            $this->bank_data->update($user_id, $data);
            echo json_encode(['status' => 200]);
            exit();
        } else {
            $data = [
                'user_id' => $user_id,
                'name_bank' => $bankName,
                'number_account' => $numberAcount,
                'type_account' => $typeAcount,
                'name_titular' => $nameTitular,
                'number_id' => $numberAcount,
                'email' => $emailContact,
                'phone' => $phoneContact
            ];
            $id = $this->bank_data->create($data);
            if ($id) {
                echo json_encode(['status' => 200]);
                exit();
            } else {
                echo json_encode(['status' => 500, 'msg' => "Ocurrió un error vuelva a intentarlo"]);
                exit();
            }
        }
    }
    public function validate_email()
    {
        $email = $this->input->post('email');

        $user = $this->user->get_user_by_email($email);
        $result = null;
        if ($user) {
            $result = json_encode(['status' => 200, 'data' => $user]);
        } else {
            $result = json_encode(['status' => 404]);
        }
        echo $result;
        exit();
    }

    public function tranferir_saldo()
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            echo json_encode(['status' => 500, 'msg' => "No tiene permiso para realizar esta tarea"]);
            exit();
        }
        $email = $this->input->post('email');
        $monto = (float)$this->input->post('monto');
        $this->load->model('Wallet_model', 'wallet');
        $this->load->model('Transaction_model', 'transaction');
        $user_id = $this->session->userdata('user_id');
        $fecha = date('Y-m-d H:i:s');
        $wallet_send = $this->wallet->get_wallet_by_user_id($user_id);
        $user_receives = $this->user->get_user_by_email($email);
        $wallet_receives = $this->wallet->get_wallet_by_user_id($user_receives->user_id);
        if ($wallet_receives) {
            $balance = (float)$wallet_receives->balance + $monto;
            $data_transactions = [
                'date_create' => $fecha,
                'amount' => $monto,
                'wallet_send' =>  $wallet_send->wallet_id,
                'type' => 2,
                'balance_previous' => $wallet_receives->balance,
                'balance' => $balance,
                'wallet_receives' => $wallet_receives->wallet_id,
                'status' => 1
            ];
            $this->transaction->create($data_transactions);
            $this->wallet->update($wallet_receives->wallet_id, ['balance' => $balance]);
            $balanceSend =  (float)$wallet_send->balance - $monto;
            $this->wallet->update($wallet_send->wallet_id, ['balance' => $balanceSend]);
            echo json_encode(['status' => 200, 'msg' => "Correcto"]);
            exit();
        } else {
            $data_wallet = [
                'user_id' => $user_receives->user_id,
                'points' => 0,
                'balance' => 0
            ];
            $wallet_id = $this->wallet->create($data_wallet);
            if ($wallet_id > 0) {
                $data_transactions = [
                    'date_create' => $fecha,
                    'amount' => $monto,
                    'wallet_send' =>  $wallet_send->wallet_id,
                    'type' => 2,
                    'balance_previous' => 0,
                    'balance' => $monto,
                    'wallet_receives' => $wallet_id,
                    'status' => 1
                ];
                $this->transaction->create($data_transactions);
                $this->wallet->update($wallet_id, ['balance' => $monto]);
                $balanceSend =  (float)$wallet_send->balance - $monto;
                $this->wallet->update($wallet_send->wallet_id, ['balance' => $balanceSend]);
                echo json_encode(['status' => 200, 'msg' => "Correcto"]);
                exit();
            } else {
                echo json_encode(['status' => 500, 'msg' => "Ocurrió un error vuelva a intentarlo"]);
                exit();
            }
        }
    }
    public function variable_config()
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            echo json_encode(['status' => 500, 'msg' => "No tiene permiso para realizar esta tarea"]);
            exit();
        }
        $node = json_decode($this->input->post('node'));
        $variable = $this->input->post('variable');
        $this->load->model('Tree_node_model', 'tree');
        $this->tree->update($node->tree_node_id, ['variable_config' => $variable]);

        echo json_encode(['status' => 200]);
        exit();
    }
    public function payment_membresia_wallet()
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            echo json_encode(['status' => 500, 'msg' => "No tiene permiso para realizar esta tarea"]);
            exit();
        }
        $this->load->model('Wallet_model', 'wallet');
        $this->load->model('Tree_node_model', 'tree_node');
        $this->load->model('Transaction_model', 'transaction');
        $this->load->model('Membresia_model', 'membresia');
        $membresiaId = $this->input->post('membresiaId');
        $renovate = $this->input->post('renovate');
        $user_id = $this->session->userdata('user_id');
        $wallet_cliente = $this->wallet->get_wallet_by_user_id($user_id);
        $cliente = $this->user->get_by_id($user_id);
        $object_membresia = $this->membresia->get_by_id($membresiaId);
        $fecha = date('Y-m-d H:i:s');
        $duracion = '+' . $object_membresia->duracion . ' day';
        $fecha_fin = strtotime($duracion, strtotime($fecha));
        $fecha_fin = date('Y-m-d H:i:s', $fecha_fin);
        $fecha_mes = strtotime('+30 day', strtotime($fecha));
        $fecha_mes = date('Y-m-d', $fecha_mes);
        $emailAdmid = '';
        if (ENVIRONMENT == "development") {
            $emailAdmid = 'pedroduran014@gmail.com';
        }
        if (ENVIRONMENT == "production") {
            $emailAdmid = 'comercial@subastanuncios.com';
        }
        if ($wallet_cliente) {
            if ($wallet_cliente->balance >= $object_membresia->precio) {
                $monto = $wallet_cliente->balance - $object_membresia->precio;
                $data_transactions = [
                    'date_create' => $fecha,
                    'amount' => $object_membresia->precio,
                    'wallet_send' =>  $wallet_cliente->wallet_id,
                    'type' => 4,
                    'balance_previous' => $wallet_cliente->balance,
                    'balance' => $monto,
                    'wallet_receives' => 0,
                    'status' => 1
                ];
                $this->transaction->create($data_transactions);
                $this->wallet->update($wallet_cliente->wallet_id, ['balance' => $monto]);
                if ($renovate == 'false') {
                    if ($cliente->parent != 0) {
                        $wallet_parent = $this->wallet->get_wallet_by_user_id($cliente->parent);
                        $nodeParent = $this->tree_node->get_node_renovate_by_user_id($cliente->parent);
                        $amount = (float)$object_membresia->precio * 0.20;
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
                        }
                    }
                    $data = [
                        'user_id' => $user_id,
                        'membresia_id' => $membresiaId,
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
                            $admin  = $this->user->get_user_by_email_active($emailAdmid);
                            if ($admin) {
                                $node = $this->tree_node->get_node_row_by_user_id($admin->user_id);
                                $data_node = [
                                    'membre_user_id' => $valor,
                                    'variable_config' => 0,
                                    'is_active' => 0,
                                    'is_delete' => 0,
                                    'points_left' => 0,
                                    'points_right' => 0,
                                    'date_active' => $fecha,
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
                                                $totalPoinstRight = (float)$nodeTemp->total_point_right + $points;
                                                $data_node = [
                                                    'points_right' => $pointsRight,
                                                    'total_point_right' => $totalPoinstRight
                                                ];
                                                $this->tree_node->update($nodeTemp->tree_node_id, $data_node);
                                            }
                                        } else {
                                            $childremsLeft = $this->tree_node->get_all_children($nodeTemp->tree_node_id, 1);
                                            if (count($childremsLeft) > 0) {
                                                $pointsLeft = (float)$nodeTemp->points_left + $points;
                                                $totalPoinstLeft = (float)$nodeTemp->total_points_left + $points;
                                                $data_node = [
                                                    'points_left' => $pointsLeft,
                                                    'total_points_left' => $totalPoinstLeft
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
                                $node_parent = $this->tree_node->get_node_by_user($cliente->user_id);
                                $data_node = [
                                    'membre_user_id' => $valor,
                                    'is_active' => 1,
                                    'date_active' => $fecha,
                                    'active' => 1
                                ];
                                $this->tree_node->update($node_parent->tree_node_id, $data_node);
                            }
                        }
                        echo json_encode(['status' => 200, 'msg' => "Correcto"]);
                        exit();
                    }
                } else {
                    $node = $this->tree_node->get_node_renovate_by_user_id($cliente->user_id);
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
                                $continue = true;
                            }
                        } while ($continue);
                        $this->tree_node->update($node_parent->tree_node_id, $dataNode);
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
                    $this->tree_node->update($node->tree_node_id, $dataNode);
                    echo json_encode(['status' => 200, 'msg' => "Correcto"]);
                    exit();
                }
            } else {
                echo json_encode(['status' => 500, 'msg' => "Ocurrió un error vuelva a intentarlo"]);
                exit();
            }
        } else {
            echo json_encode(['status' => 500, 'msg' => "Ocurrió un error vuelva a intentarlo"]);
            exit();
        }
    }

    public function request_transfer_balance()
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            echo json_encode(['status' => 500, 'msg' => "No tiene permiso para realizar esta tarea"]);
            exit();
        }
        $monto = $this->input->post('montoSolicitado');
        $this->load->model('Wallet_model', 'wallet');
        $this->load->model('Transaction_model', 'transaction');
        $user_id = $this->session->userdata('user_id');
        $fecha = date('Y-m-d H:i:s');
        $wallet_send = $this->wallet->get_wallet_by_user_id($user_id);
        if ($wallet_send) {
            $balance = (float)$wallet_send->balance - $monto;
            $data_transactions = [
                'date_create' => $fecha,
                'amount' => $monto,
                'wallet_send' =>  $wallet_send->wallet_id,
                'type' => 5,
                'balance_previous' => $wallet_send->balance,
                'balance' => $balance,
                'wallet_receives' => 0,
                'status' => 1,
                'bitcoin' => 0
            ];
            $this->transaction->create($data_transactions);
            $this->wallet->update($wallet_send->wallet_id, ['balance' => $balance]);
            echo json_encode(['status' => 200, 'msg' => "Correcto"]);
            exit();
        } else {
            echo json_encode(['status' => 500, 'msg' => "Ocurrió un error vuelva a intentarlo"]);
            exit();
        }
    }
    public function request_transfer_bitboin()
    {
        if (!in_array($this->session->userdata('role_id'), [2])) {
            echo json_encode(['status' => 500, 'msg' => "No tiene permiso para realizar esta tarea"]);
            exit();
        }
        $this->load->model('User_model', 'user');
        $monto = $this->input->post('montoSolicitado');
        $walletBitcoin = $this->input->post('walletBitcoin');
        $emailWallet = $this->input->post('emailWallet');
        $this->load->model('Wallet_model', 'wallet');
        $this->load->model('Transaction_model', 'transaction');
        $user_id = $this->session->userdata('user_id');
        $fecha = date('Y-m-d H:i:s');
        $wallet_send = $this->wallet->get_wallet_by_user_id($user_id);
        $this->user->update($user_id, ['email_wallet' => $emailWallet, 'wallet_bitcoin' => $walletBitcoin]);
        if ($wallet_send) {
            $balance = (float)$wallet_send->balance - $monto;
            $data_transactions = [
                'date_create' => $fecha,
                'amount' => $monto,
                'wallet_send' =>  $wallet_send->wallet_id,
                'type' => 5,
                'balance_previous' => $wallet_send->balance,
                'balance' => $balance,
                'wallet_receives' => 0,
                'status' => 1,
                'bitcoin' => 1
            ];
            $this->transaction->create($data_transactions);
            $this->wallet->update($wallet_send->wallet_id, ['balance' => $balance]);
            echo json_encode(['status' => 200, 'msg' => "Correcto"]);
            exit();
        } else {
            echo json_encode(['status' => 500, 'msg' => "Ocurrió un error vuelva a intentarlo"]);
            exit();
        }
    }
}
