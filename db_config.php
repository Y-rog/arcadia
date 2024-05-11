<?php
require_once 'vendor/autoload.php';

use Dotenv\Dotenv;


// Load environment variables
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
    return [
        'db_name' => getenv('DB_NAME'),
        'db_user' => getenv('DB_USER'),
        'db_password' => getenv('DB_PASSWORD'),
        'db_port' => getenv('DB_PORT'),
        'db_host' => getenv('DB_HOST'),
        'mongodb_uri' => getenv('MONGODB_URI'),
    ];
}
