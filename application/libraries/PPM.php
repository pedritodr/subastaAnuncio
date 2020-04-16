<?php defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Rafael
 * Date: 2/5/2018
 * Time: 14:33
 */
require("./vendor/autoload.php");

class PPM
{
    private $ci;
    private $place_to_pay_object;
    private $login;
    private $trankey;
    private $url;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->login = "6dd79d14d110adedc41f3fbab8e58461";
        $this->trankey = "h61ByK5IO930k2T8";
        $this->url = "https://test.placetopay.ec/redirection/";

        $this->place_to_pay_object = new Dnetix\Redirection\PlacetoPay([
            'login' => $this->login,
            'tranKey' => $this->trankey,
            'url' => $this->url
        ]);
    }

    public function get_object_place_to_pay()
    {
        return $this->place_to_pay_object;
    }


    public function create_request_payment($return_url = "", $reference, $total_to_pay, $tax_to_pay)
    {

        $request = [
            'payment' => [
                'reference' => $reference,
                'description' => 'Testing payment',
                'amount' => [
                    'currency' => 'USD',
                    'total' => number_format($total_to_pay, 2),
                    "taxes" => [
                        "kind" => "valueAddedTax",
                        "amount" => number_format($tax_to_pay, 2),
                        "base" => 4
                    ],
                ],
            ],
            'expiration' => date('c', strtotime('+20 minute')),
            'returnUrl' => $return_url
        ];


        $response = $this->place_to_pay_object->request($request);
        if ($response->isSuccessful()) {
            $this->ci->load->model('Solicitud_model', 'sol');
            $id_ppm = $response->requestId();
            $processUrl = $response->processUrl();
            //if($id_ppm>0)
            $this->ci->sol->update_ppm_oferta($reference, $id_ppm, $processUrl);

            // STORE THE $response->requestId() and $response->processUrl() on your DB associated with the payment order
            // Redirect the client to the processUrl or display it on the JS extension
            header('Location: ' . $response->processUrl());
        } else {
            // There was some error so check the message and log it
            return $response->status()->message();
        }
    }

    public function create_request_payment2($return_url = "", $reference, $total_to_pay, $description, $tax_to_pay, $base_to_pay, $nombre, $email, $document, $telef)
    {

        $request = [
            "locale" => "es_EC",
            "buyer" => [
                "name" => $nombre,
                "email" => $email,
                "documentType" => "CI",
                "document" => $document,
                "mobile" => $telef,
                "address" => [],
            ],
            'payment' => [
                'reference' => $reference,
                'description' => $description,
                'amount' => [
                    'currency' => 'USD',
                    'total' => number_format($total_to_pay, 2),
                    "taxes" => [
                        [
                            "kind" => "valueAddedTax",
                            "amount" => number_format($tax_to_pay, 2),
                            "base" => number_format($base_to_pay, 2)
                        ],

                    ],
                ],

            ],
            'expiration' => date('c', strtotime('+20 minute')),
            'returnUrl' => $return_url
        ];


        $response = $this->place_to_pay_object->request($request);
        if ($response->isSuccessful()) {
            $this->ci->load->model('Solicitud_model', 'sol');
            $id_ppm = $response->requestId();
            $processUrl = $response->processUrl();
            //if($id_ppm>0)
            $this->ci->sol->update_ppm_oferta($reference, $id_ppm, $processUrl);

            // STORE THE $response->requestId() and $response->processUrl() on your DB associated with the payment order
            // Redirect the client to the processUrl or display it on the JS extension
            return $response;
        } else {
            // There was some error so check the message and log it
            return $response->status()->message();
        }
    }

    public function consultar_respuesta($order_id)
    {
        $response = $this->place_to_pay_object->query($order_id);

        //var_dump($response->request); exit();

        if ($response->isSuccessful()) {
            return $response;
            if ($response->status()->isApproved()) {
                return [1, translate('pago_ok_lang')];
            } else {
                return [0, translate('pago_pend_lang')];
            }
        } else {
            return [-1, $response->status()->message() . "\n"];
        }
    }

    public function reverse($order_id)
    {
        $response = $this->place_to_pay_object->query($order_id);
        if (isset($response)) {
            // $cant = count($response->payment());
            //$internal = $response->payment()[$cant - 1]->internalReference();
            $internal = $response->payment()[0]->internalReference();
            //var_dump($internal);exit();
            $response = $this->place_to_pay_object->reverse($internal);
            return $response;
            //var_dump($response); exit();
            /*   $response = $this->place_to_pay_object->query($order_id);

            if ($response->isSuccessful()) {
                return $response;
                if ($response->status()->isApproved()) {
                    return [1, translate('pago_ok_lang')];
                } else {
                    return [0, translate('pago_pend_lang')];
                }
            } else {
                return [-1, $response->status()->message() . "\n"];
            } */
        }
    }
}
