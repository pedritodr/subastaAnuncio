<?php
require(APPPATH . "libraries/REST_Controller.php");
require(APPPATH . "libraries/DatalabSecurity.php");
//require(APPPATH . "libraries/proveedores/AlignetWallet.php");
class Rest_anuncio extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('User_model', 'user');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }


    public function anuncio_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');

        $auth = $this->user->is_valid_auth($user_id, $security_token);

        if ($auth) {
            $all_anuncio = $this->anuncio->get_all(['is_active' => 1]);

            $this->load->model("Cate_anuncio_model", "categoria");
            $this->load->model('Pais_model', 'pais');
            foreach ($all_anuncio as $item) {
                $categoria_object = $this->categoria->get_all_categorias($item->categoria_id);
                $item->categoria = $categoria_object;

                $ciudad_object = $this->pais->get_by_ciudad_id_object($item->ciudad_id);
                $item->ciudad = $ciudad_object;
            }
            if ($all_anuncio) {

                $this->response(['status' => 200, 'lista' => $all_anuncio]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }

    public function cargar_anuncios_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $limite = $this->input->post('limite');
        $comienza = $this->input->post('comienza');
        $limite = 11;
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        $infinito = false;
        if ($comienza > 0) {
            $infinito = true;
        }
        if ($auth) {
            $all_anuncios = $this->anuncio->get_all_anuncios_with_pagination($limite, $comienza);
            foreach ($all_anuncios as $item) {
                //     $item->titulo = str_replace("´", "", $item->titulo);
                $title = strlen($item->titulo);
                $long = strlen($item->descripcion);
                if ($long > 99) {
                    $item->corta = substr($item->descripcion, 0, 96) . "...";
                } else {
                    $item->corta = $item->descripcion;
                }
                if ($title > 19) {
                    $item->titulo = substr($item->titulo, 0, 16) . "...";
                } else {
                    $item->titulo = $item->titulo;
                }
            }
            if ($all_anuncios) {
                $this->response(['status' => 200, 'lista' => $all_anuncios]);
            } else {
                $this->response(['status' => 404, 'infinito' => $infinito]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function cargar_anuncio2_post()
    {
        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $limite = $this->input->post('limite');
        $comienza = $this->input->post('comienza');
        $id = $this->input->post('id');
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        $limite = 11;
        if ($auth) {
            $all_anuncios = $this->anuncio->get_all_anuncios_with_pagination_by_category($limite, $comienza, $id);
            foreach ($all_anuncios as $item) {
                $long = strlen($item->descripcion);
                if ($long > 99) {
                    $item->corta = substr($item->descripcion, 0, 96) . "...";
                }
            }

            if ($all_anuncios) {

                $this->response(['status' => 200, 'lista' => $all_anuncios]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }

    public function detalle_anuncio_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $anuncio_id = $this->input->post('id');
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        // $this->response(['error' => $auth]);
        if ($auth) {
            $all_detalle = $this->anuncio->anuncio_by_id($anuncio_id);
            $foto_object = $this->anuncio->get_all_fotos(['anuncio_id' => $anuncio_id]);
            if ($all_detalle) {
                $this->response(['status' => 200, 'detalle' => $all_detalle, 'foto_object' => $foto_object]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }

    public function buscar_anuncios_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $buscar = $this->input->post('buscar');
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        $comienza = $this->input->post('comienza');
        $ubicacion = $this->input->post('ubicacion');
        $ciudad = $this->input->post('ciudad');
        $categoria = $this->input->post('categoria');
        $subcategoria = $this->input->post('subcategoria');
        $limite = 11;
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        $infinito = false;
        if ($comienza > 0) {
            $infinito = true;
        }

        if ($auth) {
            if ($ubicacion) {
                $ciudad_obj = $this->pais->get_city($ubicacion);
                if ($ciudad_obj) {
                    $ciudad = $ciudad_obj->ciudad_id;
                } else {
                    $ciudad = 0;
                }
            }
            $all_anuncios = $this->anuncio->search_by_name_pagination($limite, $comienza, $buscar, $ciudad, $categoria, $subcategoria);
            foreach ($all_anuncios as $item) {
                //     $item->titulo = str_replace("´", "", $item->titulo);
                $title = strlen($item->titulo);
                $long = strlen($item->descripcion);
                if ($long > 99) {
                    $item->corta = substr($item->descripcion, 0, 96) . "...";
                } else {
                    $item->corta = $item->descripcion;
                }
                if ($title > 19) {
                    $item->titulo = substr($item->titulo, 0, 16) . "...";
                } else {
                    $item->titulo = $item->titulo;
                }
            }

            if (count($all_anuncios) > 0) {


                $this->response(['status' => 200, 'lista' => $all_anuncios]);
            } else {
                $this->response(['status' => 404, 'infinito' => $infinito]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function anuncio_categoria_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $anuncio_id = $this->input->post('anuncio_id');
        $auth = $this->user->is_valid_auth($user_id, $security_token);

        if ($auth) {
            $this->load->model('Cate_anuncio_model', 'categoria');
            if ($anuncio_id != "" || $anuncio_id != null) {
                $obj_anuncio = $this->anuncio->get_by_id($anuncio_id);
                if ($obj_anuncio) {
                    $categoria_object = $this->categoria->get_by_subcate_id_object($obj_anuncio->subcate_id);
                    $obj_anuncio->subcategoria = $categoria_object;
                    $obj_anuncio->fotos = $this->anuncio->get_all_fotos(['anuncio_id' => $anuncio_id]);
                }
            } else {
                $obj_anuncio = null;
            }

            $all_categorias = $this->categoria->get_all(['is_active' => 1]);

            if (count($all_categorias) > 0) {

                foreach ($all_categorias as $item) {
                    $item->contador = count($this->anuncio->get_anuncios_by_category($item->cate_anuncio_id));
                }

                $this->response(['status' => 200, 'lista' => $all_categorias, 'obj_anuncio' => $obj_anuncio]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }

    public function subcategorias_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $id = $this->input->post('id');
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        if ($auth) {
            $this->load->model('Cate_anuncio_model', 'cate');
            $object = $this->cate->get_by_Cate_anuncio_id($id);

            if ($object) {

                $this->response(['status' => 200, 'object' => $object]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function add_post()
    {
        $this->load->model('Membresia_model', 'membresia');
        $this->load->model('Pais_model', 'pais');
        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $titulo = $this->input->post('titulo');
        $descripcion = $this->input->post('descripcion');
        $precio = $this->input->post('precio');
        $city = $this->input->post('city_main');
        $direccion = $this->input->post('direccion');
        $whatsapp = $this->input->post('phone');
        $subcategoria = $this->input->post('sub');
        $lng = $this->input->post('lng');
        $lat = $this->input->post('lat');
        $data = json_decode($_POST['array']);

        $auth = $this->user->is_valid_auth($user_id, $security_token);
        if ($auth) {

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
            $this->load->model('Photo_anuncio_model', 'photo_anuncio');
            define('UPLOAD_DIR', './uploads/anuncio/');
            $fotos = [];
            foreach ($data as $item) {
                $img =  $item->imagen;
                $img = str_replace('data:image/jpeg;base64,', '', $img);

                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);

                $file = UPLOAD_DIR . uniqid() . '.jpg';
                // $image = uniqid() . '.jpg';

                $success = file_put_contents($file, $data);
                array_push($fotos, $file);
            }


            $datos = [
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'precio' => $precio,
                'photo' => $fotos[0],
                'whatsapp' => $whatsapp,
                'subcate_id' => $subcategoria,
                'is_active' => 1,
                'lat' => $lat,
                'lng' => $lng,
                'ciudad_id' => $ciudad_id,
                'user_id' => $user_id,
                'direccion' => $direccion,
                'fecha' =>  $fecha,
                'destacado' => 0,
                'fecha_vencimiento' => $fecha_fin
            ];
            if ($membresia) {

                $object =  $this->anuncio->create($datos);
                if ($object) {
                    if ((int) $membresia->anuncios_publi > 0) {

                        $qty_anuncios = (int) $membresia->anuncios_publi - 1;
                        $this->membresia->update_membresia_user($membresia->membre_user_id, ['anuncios_publi' => $qty_anuncios]);
                        $this->anuncio->update($object, ['destacado' => 1]);
                    }
                }
            } else {

                $object = $this->anuncio->create($datos);
            }

            if ($object) {
                if (count($fotos) > 1) {
                    for ($i = 1; $i < count($fotos); $i++) {
                        $img =  $fotos[$i];
                        $this->photo_anuncio->create(['photo_anuncio' => $img, 'anuncio_id' => $object]);
                    }
                }
                $this->response(['status' => 200, 'object' => $object]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function update_post()
    {
        $this->load->model('Membresia_model', 'membresia');
        $this->load->model('Pais_model', 'pais');
        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $titulo = $this->input->post('titulo');
        $descripcion = $this->input->post('descripcion');
        $precio = $this->input->post('precio');
        $city = $this->input->post('city_main');
        $direccion = $this->input->post('direccion');
        $whatsapp = $this->input->post('phone');
        $subcategoria = $this->input->post('sub');
        $anuncio_id = $this->input->post('anuncio_id');
        $lng = $this->input->post('lng');
        $lat = $this->input->post('lat');
        $data = json_decode($_POST['array']);
        $this->load->model('Photo_anuncio_model', 'photo_anuncio');
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        if ($auth) {
            $object = $this->anuncio->get_by_id($anuncio_id);
            if ($object) {
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
                define('UPLOAD_DIR', './uploads/anuncio/');
                $fotos = [];
                $salva = [];
                $main_photo = "editar";
                for ($i = 0; $i < count($data); $i++) {
                    if ($i == 0) {
                        if ($data[$i]->foto_anuncio_id == null) {
                            $img =  $data[$i]->imagen;
                            $img = str_replace('data:image/jpeg;base64,', '', $img);
                            $img = str_replace(' ', '+', $img);
                            $data = base64_decode($img);
                            $file = UPLOAD_DIR . uniqid() . '.jpg';
                            $success = file_put_contents($file, $data);
                            $main_photo = $file;
                        }
                    } else {
                        if ($data[$i]->foto_anuncio_id == null) {
                            $img =  $data[$i]->imagen;
                            $img = str_replace('data:image/jpeg;base64,', '', $img);
                            $img = str_replace(' ', '+', $img);
                            $data = base64_decode($img);
                            $file = UPLOAD_DIR . uniqid() . '.jpg';
                            $success = file_put_contents($file, $data);
                            array_push($fotos, $file);
                        } else {
                            array_push($salva, $data[$i]);
                        }
                    }
                }
                if ($main_photo != "editar") {
                    unlink($object->photo);

                    $datos = [
                        'titulo' => $titulo,
                        'descripcion' => $descripcion,
                        'precio' => $precio,
                        'whatsapp' => $whatsapp,
                        'subcate_id' => $subcategoria,
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
                        'subcate_id' => $subcategoria,
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
                    foreach ($salva as $item) {
                        if ($item->foto_anuncio_id == $foto->photo_anuncio_id) {
                            $encontro = true;
                        }
                    }
                    if (!$encontro) {
                        unlink($foto->photo_anuncio);
                        $this->photo_anuncio->delete($foto->photo_anuncio_id);
                    }
                }
                if (count($fotos) > 0) {
                    for ($i = 0; $i < count($fotos); $i++) {
                        $img =  $fotos[$i];
                        $this->photo_anuncio->create(['photo_anuncio' => $img, 'anuncio_id' => $anuncio_id]);
                    }
                }
                $this->response(['status' => 200, 'object' => $object]);
            } else {
                $this->response(['status' => 404]);
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
    public function cargar_mis_anuncios_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $limite = $this->input->post('limite');
        $comienza = $this->input->post('comienza');
        $limite = 11;
        $infinito = false;
        if ($comienza > 0) {
            $infinito = true;
        }
        $auth = $this->user->is_valid_auth($user_id, $security_token);

        if ($auth) {
            $all_anuncios = $this->anuncio->get_all_anuncios_with_pagination_by_user($limite, $comienza, $user_id);
            foreach ($all_anuncios as $item) {
                $title = strlen($item->titulo);
                $long = strlen($item->descripcion);
                if ($long > 99) {
                    $item->corta = substr($item->descripcion, 0, 96) . "...";
                } else {
                    $item->corta = $item->descripcion;
                }
                if ($title > 14) {
                    $item->titulo = substr($item->titulo, 0, 14) . "...";
                } else {
                    $item->titulo = $item->titulo;
                }
            }
            if ($all_anuncios) {
                $this->response(['status' => 200, 'lista' => $all_anuncios]);
            } else {
                $this->response(['status' => 404, 'infinito' => $infinito]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    function remplace_title($cadena)
    {
        $cadena = utf8_decode($cadena);
        $cadena = str_replace('?', '', $cadena);
        $cadena = str_replace('+', '', $cadena);
        $cadena = str_replace('%', '', $cadena);
        $cadena = str_replace(',', '', $cadena);
        $cadena = str_replace('?', '', $cadena);
        $cadena = str_replace('/', '', $cadena);
        $cadena = str_replace(':', '', $cadena);
        $cadena = str_replace('(', '', $cadena);
        $cadena = str_replace(')', '', $cadena);
        $cadena = str_replace('??', '', $cadena);
        $cadena = str_replace('`', '', $cadena);
        $cadena = str_replace('!', '', $cadena);
        $cadena = str_replace('¿', '', $cadena);
        $cadena = str_replace("'", "-", $cadena);
        $cadena = str_replace("´", "-", $cadena);
        $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ??';
        $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $cadena = strtr($cadena, utf8_decode($originales), $modificadas);

        return $cadena;
    }
    public function activar_anuncio_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $anuncio_id = $this->input->post('anuncio_id');
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        if ($auth) {
            $object = $this->anuncio->get_by_id($anuncio_id);
            if ($object) {
                $row = $this->anuncio->update($anuncio_id, ['is_active' => 1]);
                $this->response(['status' => 200]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function desactivar_anuncio_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $anuncio_id = $this->input->post('anuncio_id');
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        if ($auth) {
            $object = $this->anuncio->get_by_id($anuncio_id);
            if ($object) {
                $row = $this->anuncio->update($anuncio_id, ['is_active' => 0]);
                $this->response(['status' => 200]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function filtros_post()
    {
        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $auth = $this->user->is_valid_auth($user_id, $security_token);
        if ($auth) {
            $this->load->model('Pais_model', 'pais');
            $this->load->model("Cate_anuncio_model", "categoria");
            $ciudades = $this->pais->get_by_pais_id_object(4);
            $categorias = $this->categoria->get_all(['is_active' => 1]);
            foreach ($categorias as $item) {
                $item->subcategorias = $this->categoria->get_all_sub(['cate_anuncio_id' => $item->cate_anuncio_id]);
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
}
