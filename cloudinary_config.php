<?php
require_once __DIR__ . '/vendor/autoload.php';

use Cloudinary\Cloudinary;

if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    return [
        'cloudinary_cloud_name' => $_ENV['CLOUDINARY_CLOUD_NAME'],
        'cloudinary_api_key' => $_ENV['CLOUDINARY_API_KEY'],
        'cloudinary_api_secret' => $_ENV['CLOUDINARY_API_SECRET'],
        'cloudinary_url' => $_ENV['CLOUDINARY_URL'],
    ];
} else {
    return [
        'cloudinary_cloud_name' => $_ENV['CLOUDINARY_CLOUD_NAME'],
        'cloudinary_api_key' => $_ENV['CLOUDINARY_API_KEY'],
        'cloudinary_api_secret' => $_ENV['CLOUDINARY_API_SECRET'],
        'cloudinary_url' => $_ENV['CLOUDINARY_URL'],
    ];
}
