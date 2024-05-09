<?php

namespace App\Security;

use App\Entity\FoodConsumption;

class FoodConsumptionValidator
{
    public function validateFoodConsumption(FoodConsumption $foodConsumption): array
    {
        $errors = [];
        if (empty($foodConsumption->getFoodGiven())) {
            $errors['food_given'] = 'Le nom de la nourriture est obligatoire';
        }
        if (empty($foodConsumption->getFoodQuantity())) {
            $errors['food_quantity'] = 'La quantité de nourriture est obligatoire';
        }
        if (empty($foodConsumption->getGiveAt())) {
            $errors['give_at'] = 'La date de distribution est obligatoire';
        }
        if (empty($foodConsumption->getAnimalUuid())) {
            $errors['animal_uuid'] = 'L\'identifiant de l\'animal est obligatoire';
        }
        if (empty($foodConsumption->getUserId())) {
            $errors['user_id'] = 'L\'identifiant de l\'utilisateur est obligatoire';
        }
        return $errors;
    }
}
