<?php

class Cron  extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Subasta_model', 'subasta');
        $this->load->model('Membresia_model', 'membresia');
        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->model('Subasta_model', 'subasta');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");
    }

    public function subasta_inversa()
    {
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

        define('UPLOAD_DIR', './uploads/anuncio/');
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
        $imagen_optimizada = redimensionar_imagen($image, $file, 450, 450);
        imagejpeg($imagen_optimizada, $file);
    }
    public function actualizar_membresia()
    {
        $fecha = strtotime(date("Y-m-d H:i:00", time()));

        $fecha_mes = strtotime('+30 day', $fecha);
        $fecha_mes = date('Y-m-d  H:i:00', $fecha_mes);

        $all_membresias = $this->membresia->get_all_membresias_user(['estado' => 1]);


        foreach ($all_membresias as $item) {


            $fecha_fin = strtotime($item->fecha_fin);
            // $fechaEntera = strtotime($fecha_fin);
            /*     $anio = date("Y", $fechaEntera);
            $mes = date("m", $fechaEntera);
            $dia = date("d", $fechaEntera);
            $fecha_fin = $anio . "-" . $mes . "-" . $dia; */
            if ($fecha >= $fecha_fin) {
                $this->membresia->update_membresia_user($item->membresia_user_id, ['estado' => 0]);
            }
            if ($item->mes <= 11 && $item->fecha_mes == $fecha) {
                $mes = (int) $item->mes + 1;
                $data = [
                    'anuncios_publi' => (int) $item->cant_anuncio,
                    'fecha_mes' => $fecha_mes,
                    'mes' => $mes
                ];

                $this->membresia->update_membresia_user($item->membresia_user_id, $data);
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
                $this->anuncio->update($item->anuncio_id, ['is_active' => 0]);
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
}
