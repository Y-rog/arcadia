<?php

namespace App\MongoRepository;

use MongoDB\Model\BSONDocument;

class AnimalMongoRepository extends MongoRepository
{
    public function findOneAnimalByUuid(string $uuid): BSONDocument
    {
        $client = $this->client;
        $collection = $client->arcadia->animal;
        $document = $collection->findOne(['uuid' => $uuid]);
        return $document;
    }

    public function findTenAnimalsWithHighestViewsCounter(): array
    {
        $client = $this->client;
        $collection = $client->arcadia->animal;
        $cursor = $collection->find([], ['sort' => ['viewsCounter' => -1], 'limit' => 10]);
        $animals = [];
        foreach ($cursor as $document) {
            $animals[] = $document;
        }
        return $animals;
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
            'habitat_id' => $animal->getHabitatId(),
            //On initialise le compteur de vues à 0
            'viewsCounter' => 0
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
            'habitat_id' => $animal->getHabitatId()
        ];
        $collection->updateOne(['uuid' => $animal->getUuId()], ['$set' => $data]);
        return $data;
    }

    public function updateViewsCounter($data)
    {
        $client = $this->client;
        $collection = $client->arcadia->animal;
        $viewsCounter = $data['viewsCounter'];
        $viewsCounter++;
        $collection->updateOne(['uuid' => $data['uuid']], ['$set' => ['viewsCounter' => $viewsCounter]]);
    }

    public function delete($animal)
    {
        $client = $this->client;
        $collection = $client->arcadia->animal;
        $collection->deleteOne(['uuid' => $animal->getUuid()]);
    }
}
