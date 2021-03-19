<?php

/**
 * The only purpose for this file its bootstrap the classes and generate a single point
 * to instanciate the PlacetoPay class
 */
require './vendor/autoload.php';

use Dnetix\Redirection\PlacetoPay;

/**
 * Instanciates the PlacetoPay object providing the login and tranKey, also the url that will be
 * used for the service
 * @return PlacetoPay
 */
function placetopay()
{
    return new PlacetoPay([
        'login' => '6dd79d14d110adedc41f3fbab8e58461',
        'tranKey' => 'h61ByK5IO930k2T8',
        'url' => 'https://test.placetopay.ec/redirection/',
        'type' => getenv('P2P_TYPE') ?: PlacetoPay::TP_REST
    ]);
}
