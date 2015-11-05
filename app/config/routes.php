<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

$route['404_override'] = 'app/error';
$route['default_controller'] = "app";
$route['fb(.*)'] = 'app/facebook$1';
$route['f(.*)'] = 'files/file$1';
$route['unsuscribe(.*)'] = 'app/unsuscribe$1';
$route['suscripcion(.*)'] = 'app/suscripcion$1';

$route['looks'] = 'app/looks';

$route['productos(.*)'] = 'app/products$1';
$route['colecciones(.*)'] = 'app/collections$1';
$route['rebajas(.*)'] = 'app/reductions$1';
$route['categoria/(.*)'] = 'app/department/$1';
$route['producto/(.*)'] = 'app/product/$1';
$route['look/(.*)'] = 'app/look/$1';

$route['contacto'] = 'app/contact';

$route['informacion(.*)'] = 'app/info$1';

$route['mi-cuenta(.*)'] = 'user/index$1';
$route['cart(.*)'] = 'cart/index$1';
$route['instagram'] = 'app/instagram';
$route['(.*)'] = 'app/index/$1';