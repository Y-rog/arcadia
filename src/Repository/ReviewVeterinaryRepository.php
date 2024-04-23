<?php

namespace App\Repository;

use App\Entity\ReviewVeterinary;
use App\Security\Security;

class ReviewVeterinaryRepository extends Repository
{
    public function insert()
    {
        $query = $this->pdo->prepare('INSERT INTO review_veterinary (health_status, food, food_quantity, health_status_details, animal_id, user_id) VALUES (:health_status, :food, :food_quantity, :health_status_details, :animal_id, :user_id)');
        $query->bindValue(':health_status', $reviewVeterinary->getHealthStatus(), $this->pdo::PARAM_STR);
        $query->bindValue(':food', $reviewVeterinary->getFood(), $this->pdo::PARAM_STR);
        $query->bindValue(':food_quantity', $reviewVeterinary->getFoodQuantity(), $this->pdo::PARAM_STR);
        $query->bindValue(':health_status_details', $reviewVeterinary->getHealthStatusDetails(), $this->pdo::PARAM_STR);
        $query->bindValue(':animal_id', $reviewVeterinary->getAnimalId(), $this->pdo::PARAM_INT);
        $query->bindValue(':user_id', $reviewVeterinary->getUserId(), $this->pdo::PARAM_INT);
        $query->execute();
    }
}
