<?php

class Cron  extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Subasta_model', 'subasta');
        $this->load->model('Membresia_model', 'membresia');
        $this->load->model('Anuncio_model', 'anuncio');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");
    }

    public function subasta_inversa()
    {
        $fecha = date('Y-m-d');
        $cantidad_intervalos = 0;
        $all_subasta = $this->subasta->get_all(['is_active' => 1, 'tipo_subasta' => 2]);

        foreach ($all_subasta as $item) {
            if ($item->cantidad_dias > 0 && $item->intervalo > 0) {
                $cantidad_intervalos = round((int) $item->cantidad_dias / (int) $item->intervalo);
            }

            $result = $this->subasta->get_intevalo_by_id($item->subasta_id);
            if (count($result) <= $cantidad_intervalos) {
                $object = end($result);

                if ($object->cantidad > 0 && $object->fecha == $fecha) {

                    $nuevafecha = strtotime('+' . $item->intervalo . ' day', strtotime($fecha));
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

    public function actualizar_membresia()
    {
        $fecha = date('Y-m-d');
        $fecha_mes = strtotime('+30 day', strtotime($fecha));
        $all_membresias = $this->membresia->get_all_membresias_user(['estado' => 1]);


        foreach ($all_membresias as $item) {

            $fecha_fin =  $item->fecha_fin;
            $fechaEntera = strtotime($fecha_fin);
            $anio = date("Y", $fechaEntera);
            $mes = date("m", $fechaEntera);
            $dia = date("d", $fechaEntera);
            $fecha_fin = $anio . "-" . $mes . "-" . $dia;
            if ($fecha == $fecha_fin) {
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
        $fecha = date('Y-m-d');

        $all_anuncios = $this->anuncio->get_all(['is_active' => 1]);


        foreach ($all_anuncios as $item) {

            $fecha_fin =  $item->fecha_vencimiento;

            if ($fecha == $fecha_fin) {
                $this->anuncio->update($item->anuncio_id, ['is_active' => 0]);
            }
        }
    }
}
