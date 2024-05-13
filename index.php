<?php
require_once 'vendor/autoload.php';
require_once __DIR__ . '/config.php';


use App\Controller\Controller;
//Sécurise le cookie de session
session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'secure' => isset($_SERVER['HTTPS']),
]);
//Démarre la session
session_start();

//on appelle le controller pour router
$controller = new Controller();
$controller->route();
