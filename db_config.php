<?php
require_once 'vendor/autoload.php';

use Dotenv\Dotenv;


//Si le fichier .env existe, on charge les variables d'environnement local
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    return [
        'db_name' => $_ENV['DB_NAME'],
        'db_user' => $_ENV['DB_USER'],
        'db_password' => $_ENV['DB_PASSWORD'],
        'db_port' => $_ENV['DB_PORT'],
        'db_host' => $_ENV['DB_HOST'],
    ];
} else {
    //Sinon on charge les variables d'environnement de production sur heroku.
    return [
        'db_name' => $_ENV['DB_NAME'],
        'db_user' => $_ENV['DB_USER'],
        'db_password' => $_ENV['DB_PASSWORD'],
        'db_port' => $_ENV['DB_PORT'],
        'db_host' => $_ENV['DB_HOST'],
    ];
}
