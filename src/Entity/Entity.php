<?php

namespace App\Entity;

use App\Tools\StringTools;


class Entity
{

    public static function createAndHydrate(array $data): static
    {
        // Ici static fait référence à la classe de l'enfant, alors que self fait référence à la classe courante
        $entity = new static();
        $entity->hydrate($data);
        return $entity;
    }

    public function hydrate(array $data)
    {
        if (count($data) > 0) {
            // On parcourt le tableau de données
            foreach ($data as $key => $value) {
                // Pour chaque donnée, on appel le setter et la méthode pour convertir en PascalCase sauf created_at et updated_at
                $methodName = 'set' . StringTools::toPascalCase($key);
                if (method_exists($this, $methodName)) {
                    if ($key == 'created_at') {
                        $value = new \DateTime($value);
                    } else if ($key == 'updated_at') {
                        $value = new \DateTime($value);
                    } else if ($key == 'passing_date') {
                        $value = new \DateTime($value);
                    } else if ($key == 'give_at') {
                        $value = new \DateTime($value);
                    }
                    $this->{$methodName}($value);
                }
            }
        }
    }
}
