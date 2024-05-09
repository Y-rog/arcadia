<?php

namespace App\Repository;

use App\Entity\Animal;
use App\Entity\Review;
use App\Security\Security;
use App\Entity\FoodConsumption;

class FoodConsumptionRepository extends Repository
{
    public function insert(FoodConsumption $foodConsumption): void
    {
        $query = $this->pdo->prepare('INSERT INTO food_consumption (food_given, food_quantity, give_at, animal_uuid, user_id) VALUES (:food_given, :food_quantity, :give_at, :animal_uuid, :user_id)');
        $query->bindValue('food_given', $foodConsumption->getFoodGiven());
        $query->bindValue('food_quantity', $foodConsumption->getFoodQuantity());
        $query->bindValue('give_at', $foodConsumption->getGiveAt()->format('Y-m-d H:i:s'));
        $query->bindValue('animal_uuid', $foodConsumption->getAnimalUuid());
        $query->bindValue('user_id', $foodConsumption->getUserId());
        $query->execute();
    }

    public function findLastFoodConsumptionByAnimal(string $animalUuid)
    {
        $query = $this->pdo->prepare('SELECT * FROM food_consumption WHERE animal_uuid = :animal_uuid ORDER BY give_at DESC LIMIT 1');
        $query->bindValue(':animal_uuid', $animalUuid);
        $query->execute();
        $foodConsumption = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($foodConsumption) {
            return FoodConsumption::createAndHydrate($foodConsumption);
        }
        return null;
    }

    public function findAllByAnimal(string $animalUuid)
    {
        $query = $this->pdo->prepare('SELECT * FROM food_consumption WHERE animal_uuid = :animal_uuid ORDER BY give_at DESC');
        $query->bindValue(':animal_uuid', $animalUuid);
        $query->execute();
        $foodConsumptions = $query->fetchAll($this->pdo::FETCH_ASSOC);
        $foodConsumptions = array_map(function ($foodConsumption) {
            return FoodConsumption::createAndHydrate($foodConsumption);
        }, $foodConsumptions);
        return $foodConsumptions;
    }
}
