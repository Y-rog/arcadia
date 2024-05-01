<?php

namespace App\Db;

use Exception;
use MongoDB\Client;

class MongoDB
{
    private $uri;
    private $client = null;
    private static $_instance = null;

    private function __construct()
    {
        $this->uri = 'mongodb://localhost:27017';
    }

    public static function getInstance(): self
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new MongoDB();
        }
        return self::$_instance;
    }

    public function getClient(): \MongoDB\Client
    {
        if (is_null($this->client)) {
            $this->client = new \MongoDB\Client($this->uri);
        }
        return $this->client;
    }
}