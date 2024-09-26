<?php

namespace App\Db;

use MongoDB\Client;

class MongoDB
{
    private $uri;
    private $client = null;
    private static $_instance = null;

    private function __construct()
    {
        $conf = require_once _ROOTPATH_ . '/mongodb_config.php';
        $this->uri = new Client($conf['mongodb_uri']);
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
