<?php
require_once 'vendor/autoload.php';

use Dotenv\Dotenv;

// si le fichier .env existe, on charge les variables d'environnement local
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    return [
        'mailgun_domain' => $_ENV['MAILGUN_DOMAIN'],
        'mailgun_api_key' => $_ENV['MAILGUN_API_KEY'],
        'jose_arcadia_email' => $_ENV['JOSE_ARCADIA_EMAIL'],
        'mailgun_country' => $_ENV['MAILGUN_COUNTRY'],
    ];
} else {
    // sinon on charge les variables d'environnement de production (sur heroku)
    return [
        'mailgun_domain' => $_ENV['MAILGUN_DOMAIN'],
        'mailgun_api_key' => $_ENV['MAILGUN_API_KEY'],
        'jose_arcadia_email' => $_ENV['JOSE_ARCADIA_EMAIL'],
        'mailgun_country' => $_ENV['MAILGUN_COUNTRY'],
    ];
};
