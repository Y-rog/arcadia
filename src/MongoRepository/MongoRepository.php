<?php

namespace App\MongoRepository;

use App\Db\MongoDB;

class MongoRepository
{
    protected \MongoDB\Client $client;

    public function __construct()
    {
        $mongo = MongoDB::getInstance();
        $this->client = $mongo->getClient();
    }
}
