<?php
require_once 'vendor/autoload.php';

use App\Controller\Controller;
//Sécurise le cookie de session
session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'secure' => isset($_SERVER['HTTPS']),
]);
//Démarre la session
session_start();

define('_ROOTPATH_', __DIR__);
define('_TEMPLATESPATH_', _ROOTPATH_ . '/templates');
define('_IMAGE_HABITAT_', '/uploads/habitats/');
define('_IMAGE_ANIMAL_', '/uploads/animals/');


//on appelle le controller pour router

$controller = new Controller();
$controller->route();
