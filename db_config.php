<?php
require_once 'vendor/autoload.php';

use Dotenv\Dotenv;

if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

return [
    'db_name' => getenv('DB_NAME'),
    'db_user' => getenv('DB_USER'),
    'db_password' => getenv('DB_PASSWORD'),
    'db_port' => getenv('DB_PORT'),
    'db_host' => getenv('DB_HOST')
];
