<?php


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

//on charge l'autoloader
spl_autoload_register();

//on appelle le controller pour router
use App\Controller\Controller;

$controller = new Controller();
$controller->route();
