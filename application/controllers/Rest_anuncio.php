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

        $auth = $this->user->is_valid_auth($user_id, $security_token);

        if ($auth) {
            $all_anuncios = $this->anuncio->get_all_anuncios_with_pagination($limite, $comienza);
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
    public function cargar_anuncio2_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');
        $limite = $this->input->post('limite');
        $comienza = $this->input->post('comienza');
        $id = $this->input->post('id');
        $auth = $this->user->is_valid_auth($user_id, $security_token);

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

        if ($auth) {
            $this->load->model('Categoria_model', 'categoria');
            $this->load->model('Pais_model', 'pais');
            $all_detalle = $this->anuncio->search_by_name($buscar);

            if (count($all_detalle) > 0) {
                foreach ($all_detalle as $item) {
                    $long = strlen($item->descripcion);
                    if ($long > 99) {
                        $item->corta = substr($item->descripcion, 0, 96) . "...";
                    }
                }

                $this->response(['status' => 200, 'lista' => $all_detalle]);
            } else {
                $this->response(['status' => 404]);
            }
        } else {
            $this->response(['status' => 500]);
        }
    }
    public function anuncio_categoria_post()
    {

        $user_id = $this->input->post('user_id');
        $security_token = $this->input->post('security_token');

        $auth = $this->user->is_valid_auth($user_id, $security_token);

        if ($auth) {
            $this->load->model('Cate_anuncio_model', 'categoria');

            $all_categorias = $this->categoria->get_all(['is_active' => 1]);

            if (count($all_categorias) > 0) {

                foreach ($all_categorias as $item) {
                    $item->contador = count($this->anuncio->get_anuncios_by_category($item->cate_anuncio_id));
                }

                $this->response(['status' => 200, 'lista' => $all_categorias]);
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
            $img =  $data[0]->imagen;
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

                return $img2;
            }
            if ($success) {
                $imagen_optimizada = redimensionar_imagen($image, $file, 750, 750);
                imagejpeg($imagen_optimizada, $file);
            }


            $datos = [
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'precio' => $precio,
                'photo' => $file,
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
                    if (count($data) > 1) {
                        for ($i = 1; $i < count($data); $i++) {

                            $img =  $data[$i]->imagen;
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

                                return $img2;
                            }
                            if ($success) {
                                $imagen_optimizada = redimensionar_imagen($image, $file, 750, 750);
                                imagejpeg($imagen_optimizada, $file);
                            }


                            $this->photo_anuncio->create(['photo_anuncio' => $file, 'anuncio_id' => $object]);
                        }
                    }
                }
            } else {

                $object = $this->anuncio->create($datos);
                if ($object) {
                    if (count($data) > 1) {
                        for ($i = 1; $i < count($data); $i++) {

                            $img =  $data[$i]->imagen;
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

                                return $img2;
                            }
                            if ($success) {
                                $imagen_optimizada = redimensionar_imagen($image, $file, 750, 750);
                                imagejpeg($imagen_optimizada, $file);
                            }


                            $this->photo_anuncio->create(['photo_anuncio' => $file, 'anuncio_id' => $object]);
                        }
                    }
                }
            }

            if ($object) {
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
}
