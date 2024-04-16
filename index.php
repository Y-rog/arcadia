<?php

define('_ROOTPATH_', __DIR__);
define('_TEMPLATESPATH_', _ROOTPATH_ . '/templates');

//on charge l'autoloader
spl_autoload_register();

//on appelle le controller pour router
use App\Controller\Controller;

$controller = new Controller();
$controller->route();
