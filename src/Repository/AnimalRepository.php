<?php

namespace App\Repository;

use App\Entity\Animal;

class AnimalRepository extends Repository
{
    public function findOneByUuid(string $uuid)
    {
        $query = $this->pdo->prepare('SELECT * FROM animal WHERE uuid = :uuid');
        $query->bindValue(':uuid', $uuid, \PDO::PARAM_STR);
        $query->execute();
        $animal = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($animal) {
            return Animal::createAndHydrate($animal);
        }
        return null;
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


    //Ajouter un animal 
    public function insert(Animal $animal)
    {
        $query = $this->pdo->prepare('INSERT INTO animal (uuid, first_name, race, image, habitat_id) VALUES (:uuid, :first_name, :race, :image, :habitat_id)');
        $query->bindValue(':uuid', $animal->getUuid(), \PDO::PARAM_STR);
        $query->bindValue(':first_name', $animal->getFirstName(), \PDO::PARAM_STR);
        $query->bindValue('race', $animal->getRace(), \PDO::PARAM_STR);
        $query->bindValue(':image', $animal->getImage(), \PDO::PARAM_STR);
        $query->bindValue(':habitat_id', $animal->getHabitatId(), \PDO::PARAM_INT);
        $query->execute();
    }

    public function update(Animal $animal)
    {
        $query = $this->pdo->prepare('UPDATE animal SET first_name = :first_name, race= :race, image = :image, habitat_id = :habitat_id WHERE uuid = :uuid');
        $query->bindValue(':uuid', $animal->getUuid(), \PDO::PARAM_STR);
        $query->bindValue(':first_name', $animal->getFirstName(), \PDO::PARAM_STR);
        $query->bindValue('race', $animal->getRace(), \PDO::PARAM_STR);
        $query->bindValue(':image', $animal->getImage(), \PDO::PARAM_STR);
        $query->bindValue(':habitat_id', $animal->getHabitatId(), \PDO::PARAM_INT);
        $query->execute();
    }


    public function delete(Animal $animal)
    {
        $query = $this->pdo->prepare('DELETE FROM animal WHERE uuid = :uuid');
        $query->bindValue(':uuid', $animal->getUuid(), \PDO::PARAM_INT);
        $query->execute();
    }
}
