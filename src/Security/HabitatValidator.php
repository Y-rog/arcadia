<?php

namespace App\Security;

use App\Entity\Habitat;


class HabitatValidator extends Security
{

    public function validateHabitat(Habitat $habitat): array
    {
        $errors = [];
        if (empty($habitat->getName())) {
            $errors['firstname'] = 'Le nom est obligatoire';
        }
        if (empty($habitat->getDescription())) {
            $errors['race'] = 'La description est obligatoire';
        }
        if (empty($habitat->getImage())) {
            $errors['image'] = 'L\'image est obligatoire';
        }
        return $errors;
    }
}
