<?php

namespace App\Repository;

use App\Entity\Habitat;
use App\Db\Mysql;
use App\Tools\StringTools;

class HabitatRepository extends Repository
{
    public function findOneById(int $id)
    {
        // préparation de la requête
        $query = $this->pdo->prepare('SELECT * FROM habitat WHERE id = :id');
        // on associe les valeurs aux paramètres pour se protéger des injections SQL
        $query->bindValue(':id', $id, \PDO::PARAM_INT);
        // on exécute la requête
        $query->execute();
        // on récupère le résultat sous forme de tableau associatif
        $habitat = $query->fetch($this->pdo::FETCH_ASSOC);
        // si on a un résultat on hydrate une instance de Habitat et on la retourne sinon on retourne null
        if ($habitat) {
            return Habitat::createAndHydrate($habitat);
        }
        return null;
    }

    public function findAll()
    {
        $query = $this->pdo->prepare('SELECT * FROM habitat');
        $query->execute();
        $habitats = $query->fetchAll($this->pdo::FETCH_ASSOC);
        if ($habitats) {
            foreach ($habitats as $key => $habitat) {
                $habitatsEntities[] = Habitat::createAndHydrate($habitat);
            }
        } else {
            $habitatsEntities = [];
        }
        return $habitatsEntities;
    }

    public function insert(Habitat $habitat)
    {
        $query = $this->pdo->prepare('INSERT INTO habitat (name, description, image) VALUES (:name, :description, :image)');
        $query->bindValue(':name', $habitat->getName(), \PDO::PARAM_STR);
        $query->bindValue(':description', $habitat->getDescription(), \PDO::PARAM_STR);
        $query->bindValue(':image', $habitat->getImage(), \PDO::PARAM_STR);
        $query->execute();
    }

    public function delete(Habitat $habitat)
    {
        $query = $this->pdo->prepare('DELETE FROM habitat WHERE id = :id');
        $query->bindValue(':id', $habitat->getId(), \PDO::PARAM_INT);
        $query->execute();
    }

    public function edit(Habitat $habitat)
    {
        $query = $this->pdo->prepare('UPDATE habitat SET name = :name, description = :description, image = :image WHERE id = :id');
        $query->bindValue(':name', $habitat->getName(), \PDO::PARAM_STR);
        $query->bindValue(':description', $habitat->getDescription(), \PDO::PARAM_STR);
        $query->bindValue(':image', $habitat->getImage(), \PDO::PARAM_STR);
        $query->bindValue(':id', $habitat->getId(), \PDO::PARAM_INT);
        $query->execute();
    }
}
