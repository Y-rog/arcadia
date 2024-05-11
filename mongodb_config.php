<?php
require_once 'vendor/autoload.php';

use Dotenv\Dotenv;


// Load environment variables
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    return [
        'mongodb_uri' => $_ENV['MONGODB_URI']
    ];
} else {
    return [
        'mongodb_uri' => getenv('MONGODB_URI'),
    ];
}
