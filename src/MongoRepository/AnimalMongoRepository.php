<?php

namespace App\MongoRepository;

use MongoDB\Model\BSONDocument;

class AnimalMongoRepository extends MongoRepository
{
    public function findOneAnimalById(int $uuid): BSONDocument
    {
        $client = $this->client;
        $collection = $client->arcadia->animal;
        $document = $collection->findOne(['uuid' => $uuid]);
        return $document;
    }

    public function findAllAnimals(): array
    {
        $client = $this->client;
        $collection = $client->arcadia->animal;
        $cursor = $collection->find();
        $animals = [];
        foreach ($cursor as $document) {
            $animals[] = $document;
        }
        return $animals;
    }

    public function insert($animal)
    {
        $client = $this->client;
        $collection = $client->arcadia->animal;
        $data = [
            'uuid' => $animal->getUuid(),
            'first_name' => $animal->getFirstname(),
            'race' => $animal->getRace(),
            'image' => $animal->getImage(),
            'habitat_id' => $animal->getHabitatId()
        ];
        $collection->insertOne($data);
        return $data;
    }


    public function update($animal)
    {
        $client = $this->client;
        $collection = $client->arcadia->animal;
        $data = [
            'uuid' => $animal->getUuid(),
            'first_name' => $animal->getFirstname(),
            'race' => $animal->getRace(),
            'image' => $animal->getImage(),
            'habitat_id' => $animal->getHabitatId()
        ];
        $collection->updateOne(['uuid' => $animal->getUuId()], ['$set' => $data]);
        return $data;
    }

    public function delete($animal)
    {
        $client = $this->client;
        $collection = $client->arcadia->animal;
        $collection->deleteOne(['uuid' => $animal->getUuid()]);
    }
}
