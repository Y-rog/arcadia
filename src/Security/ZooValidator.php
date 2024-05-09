<?php

namespace App\Security;

use App\Entity\Zoo;

class ZooValidator extends Security
{
    public function validateZoo(Zoo $zoo): array
    {
        $errors = [];
        if (empty($zoo->getSchedules())) {
            $errors['schedules'] = 'Les horaires sont obligatoires';
        }
        return $errors;
    }
}
