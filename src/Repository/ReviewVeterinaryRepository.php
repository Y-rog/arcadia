<?php

namespace App\Repository;

use App\Entity\Animal;
use App\Entity\Review;
use App\Security\Security;
use App\Entity\ReviewVeterinary;

class ReviewVeterinaryRepository extends Repository
{
    public function insert(ReviewVeterinary $reviewVeterinary)
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

    public function findLastReviewVeterinaryByAnimal(int $animalId)
    {
        $query = $this->pdo->prepare('SELECT * FROM review_veterinary WHERE animal_id = :animal_id ORDER BY created_at DESC LIMIT 1');
        $query->bindValue(':animal_id', $animalId, $this->pdo::PARAM_INT);
        $query->execute();
        $reviewVeterinary = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($reviewVeterinary) {
            return ReviewVeterinary::createAndHydrate($reviewVeterinary);
        }
        return null;
    }
}
