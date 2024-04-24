<?php

namespace App\Repository;

use App\Entity\Animal;
use App\Entity\Review;
use App\Entity\ReviewVeterinary;

class AnimalRepository extends Repository
{
    public function findOneById(int $id)
    {
        $query = $this->pdo->prepare('SELECT * FROM animal WHERE id = :id');
        $query->bindValue(':id', $id, \PDO::PARAM_INT);
        $query->execute();
        $animal = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($animal) {
            return Animal::createAndHydrate($animal);
        }
        return null;
    }

    public function findAll()
    {
        $query = $this->pdo->prepare('SELECT * FROM animal');
        $query->execute();
        $animals = $query->fetchAll($this->pdo::FETCH_ASSOC);
        $animalEntities = [];
        if ($animals) {
            foreach ($animals as $animal) {
                $animalEntities[] = Animal::createAndHydrate($animal);
            }
        }
        return $animalEntities;
    }

    public function findAllByHabitat(int $habitatId)
    {
        $query = $this->pdo->prepare('SELECT * FROM animal WHERE habitat_id = :habitat_id');
        $query->bindValue(':habitat_id', $habitatId, \PDO::PARAM_INT);
        $query->execute();
        $animals = $query->fetchAll($this->pdo::FETCH_ASSOC);
        $animalEntities = [];
        if ($animals) {
            foreach ($animals as $animal) {
                $animalEntities[] = Animal::createAndHydrate($animal);
            }
        }
        return $animalEntities;
    }


    public function insert(Animal $animal)
    {
        if ($animal->getId() === null) {
            $query = $this->pdo->prepare('INSERT INTO animal (first_name, race, image, habitat_id) VALUES (:first_name, :race, :image, :habitat_id)');
            $query->bindValue(':first_name', $animal->getFirstname(), \PDO::PARAM_STR);
            $query->bindValue(':race', $animal->getRace(), \PDO::PARAM_STR);
            $query->bindValue(':image', $animal->getImage(), \PDO::PARAM_STR);
            $query->bindValue(':habitat_id', $animal->getHabitatId(), \PDO::PARAM_INT);
            $query->execute();
            return $this->pdo->lastInsertId();
        } else {
            $query = $this->pdo->prepare('UPDATE animal SET first_name = :first_name, race=:race, image=:image, habitat_id=:habitat_id WHERE id = :id');
            $query->bindValue(':id', $animal->getId(), \PDO::PARAM_INT);
            $query->bindValue(':first_name', $animal->getFirstname(), \PDO::PARAM_STR);
            $query->bindValue(':race', $animal->getRace(), \PDO::PARAM_STR);
            $query->bindValue(':image', $animal->getImage(), \PDO::PARAM_STR);
            $query->bindValue(':habitat_id', $animal->getHabitatId(), \PDO::PARAM_INT);
            $query->execute();
            return $animal->getId();
        }
    }

    public function delete(int $id)
    {
        $query = $this->pdo->prepare('DELETE FROM animal WHERE id = :id');
        $query->bindValue(':id', $id, \PDO::PARAM_INT);
        $query->execute();
    }
}
