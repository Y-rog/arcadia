<?php

namespace App\Security;

use App\Entity\ReviewVeterinary;


class ReviewVeterinaryValidator extends Security
{

    public function validateReviewVeterinary(ReviewVeterinary $reviewVeterinary): array
    {
        $errors = [];
        if (empty($reviewVeterinary->getHealthStatus())) {
            $errors['health_status'] = 'Le statut de santé est obligatoire';
        }
        if (empty($reviewVeterinary->getFood())) {
            $errors['food'] = 'La nourriture est obligatoire';
        }
        if (empty($reviewVeterinary->getFoodQuantity())) {
            $errors['food_quantity'] = 'La quantité de nourriture est obligatoire';
        }
        return $errors;
    }
}
