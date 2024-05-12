<?php
require_once 'vendor/autoload.php';

use Dotenv\Dotenv;


// si le fichier .env existe, on charge les variables d'environnement local
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    return [
        'mongodb_uri' => $_ENV['MONGODB_URI']
    ];
} else {
    // sinon on charge les variables d'environnement de production (sur heroku)
    return [
        'mongodb_uri' => $_ENV['MONGODB_URI'],
    ];
}
