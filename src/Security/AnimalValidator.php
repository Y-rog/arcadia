<?php

namespace App\Security;

use App\Entity\Animal;


class AnimalValidator extends Security
{

    public function validateAnimal(Animal $animal): array
    {
        $errors = [];
        if (empty($animal->getFirstName())) {
            $errors['firstname'] = 'Le prénom est obligatoire';
        }
        if (empty($animal->getRace())) {
            $errors['race'] = 'La race est obligatoire';
        }
        if (empty($animal->getImage())) {
            $errors['image'] = 'L\'image est obligatoire';
        }
        if (empty($animal->getHabitatId())) {
            $errors['habitatId'] = 'L\'habitat est obligatoire';
        }
        return $errors;
    }
}
