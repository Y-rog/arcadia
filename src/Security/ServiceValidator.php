<?php

namespace App\Security;

use App\Entity\Service;


class ServiceValidator extends Security
{

    public function validateService(Service $service): array
    {
        $errors = [];
        if (empty($service->getTitle())) {
            $errors['title'] = 'Le titre est obligatoire';
        }
        if (empty($service->getDescription())) {
            $errors['description'] = 'La description est obligatoire';
        }
        return $errors;
    }
}
