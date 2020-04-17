<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'front';
$route['404_override'] = 'front/show_404';
$route['translate_uri_dashes'] = FALSE;

$route['portada'] = 'front/index';
$route['login'] = 'front/llamar_login';
$route['crear-anuncio'] = 'front/anuncio';
$route['detalles_anuncio'] = 'front/detalle_anuncio';
$route['contacto'] = 'front/contacto';
$route['nosotros'] = 'front/about';
$route['membresia'] = 'front/membresia';
$route['registrarse'] = 'front/registrar';
$route['listado-anuncio'] = 'front/Lista_anuncio';
//$route['perfil'] = 'front/perfil';
$route['subastas_inversas'] = 'front/subasta_inversa';
$route['subastas_directas'] = 'front/subasta_directa';
//$route['anuncios'] = 'front/anuncios_index';
$route['prueba'] = 'front/prueba';
$route['search_subasta_directa'] = 'front/buscar_subasta_directa';
$route['search_subasta_inversa'] = 'front/buscar_subasta_inversa';
$route['search_anuncios'] = 'front/buscar_anuncio';
$route['faqs'] = 'front/faq';
//$route['payment/(:any)'] = 'front/pago_exitoso/$1';
$route['payment'] = 'front/pago_exitoso';
$route['transaccion_cancelada'] = 'front/pago_cancelada';

require_once(BASEPATH . 'database/DB' . '.php');
$db = &DB();
$page = 5;
$route[strtolower('subastas_directas/page')] = 'front/subasta_directa/';
for ($i = 0; $i < 20; $i++) {
    $route[strtolower('subastas_directas/page/' . $page)] = 'front/subasta_directa/' . $page;
    $page += 5;
}
$page2 = 5;
$route[strtolower('subastas_inversas/page')] = 'front/subasta_inversa/';
for ($i = 0; $i < 20; $i++) {
    $route[strtolower('subastas_inversas/page/' . $page2)] = 'front/subasta_inversa/' . $page2;
    $page2 += 5;
}
$page3 = 8;
$route[strtolower('anuncios/page')] = 'front/anuncios_index';

for ($i = 0; $i < 30; $i++) {
    $route[strtolower('anuncios/page/' . $page3)] = 'front/anuncios_index/' . $page3;
    $page3 += 8;
}

$page4 = 6;
$route[strtolower('perfil/page')] = 'front/perfil';
for ($i = 0; $i < 20; $i++) {
    $route[strtolower('perfil/page/' . $page4)] = 'front/perfil/' . $page4;
    $page4 += 6;
}
$route[strtolower('search_anuncios/page')] = 'front/buscar_anuncio';
$page5 = 8;
for ($i = 0; $i < 30; $i++) {
    $route[strtolower('search_anuncios/page/' . $page5)] = 'front/buscar_anuncio/' . $page5;
    $page5 += 8;
}
$route[strtolower('search_subastas/page')] = 'front/buscar_subasta_directa';
$page6 = 8;
for ($i = 0; $i < 30; $i++) {
    $route[strtolower('search_subastas/page/' . $page6)] = 'front/buscar_subasta_directa/' . $page6;
    $page6 += 8;
}

$query = $db->get('anuncio');
$result = $query->result();
foreach ($result as $row) {
    $route[strtolower('anuncio/' . strtolower(seo_url($row->titulo))) . $row->anuncio_id] = 'front/detalle_anuncio/' . $row->anuncio_id;
    $route[strtolower('update_anuncio/' . strtolower(seo_url($row->titulo))) . $row->anuncio_id] = 'front/update_anuncio_index/' . $row->anuncio_id;
}

/*
$query = $db->get('solicitud');
$result = $query->result();
//var_dump($result);
//die();
foreach ($result as $row) {
    $route['intercambiar-informacion/' . $row->solicitud_id] = 'front/chat/' . $row->solicitud_id;
}

$query = $db->get('noticia');
$result = $query->result();
foreach ($result as $row) {
    $route[strtolower('noticia/' . strtolower(seo_url($row->nombre)))] = 'front/view_new/' . $row->noticia_id;
}
*/
/*
$query = $db->get( 'categoria' );
$result = $query->result();
foreach( $result as $row )
{
    $route[strtolower('universidad/categoria/'.strtolower(seo_url($row->nombre)))] = 'front/news/'.$row->categoria_id;
}

*/
function seo_url($cadena)
{
    $cadena = utf8_decode($cadena);
    $cadena = str_replace(' ', '-', $cadena);
    $cadena = str_replace('%', '', $cadena);
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
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ??';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);

    return $cadena;
}
