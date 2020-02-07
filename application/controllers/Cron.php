<?php

class Cron  extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Subasta_model', 'subasta');
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
}
