<?php

namespace App\Repository;

use App\Entity\Service;
use App\Security\Security;

class ServiceRepository extends Repository
{
    public function findOneById(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM service WHERE id = :id");
        $query->bindParam(':id', $id, $this->pdo::PARAM_STR);
        $query->execute();
        $service = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($service) {
            return Service::createAndHydrate($service);
        } else {
            return false;
        }
    }

    public function findAll()
    {
        $query = $this->pdo->prepare("SELECT * FROM service");
        $query->execute();
        $services = $query->fetchAll($this->pdo::FETCH_ASSOC);
        $servicesList = [];
        foreach ($services as $service) {
            $servicesList[] = Service::createAndHydrate($service);
        }
        return $servicesList;
    }

    public function register(Service $service)
    {
        if ($service->getId() === null) {
            $query = $this->pdo->prepare('INSERT INTO service (title, description, user_id) VALUES (:title, :description, :user_id)');
            $query->bindValue(':title', $service->getTitle(), \PDO::PARAM_STR);
            $query->bindValue(':description', $service->getDescription(), \PDO::PARAM_STR);
            $query->bindValue(':user_id', Security::getCurrentUserId(), \PDO::PARAM_INT);
            $query->execute();
            return $this->pdo->lastInsertId();
        } else {
            $query = $this->pdo->prepare('UPDATE service SET title = :title, description = :description, user_id= :user_id WHERE id = :id');
            $query->bindValue(':id', $service->getId(), \PDO::PARAM_INT);
            $query->bindValue(':title', $service->getTitle(), \PDO::PARAM_STR);
            $query->bindValue(':description', $service->getDescription(), \PDO::PARAM_STR);
            $query->bindValue(':user_id', Security::getCurrentUserId(), \PDO::PARAM_INT);
            $query->execute();
            return $service->getId();
        }
    }

    public function delete(Service $service)
    {
        $query = $this->pdo->prepare('DELETE FROM service WHERE id = :id');
        $query->bindValue(':id', $service->getId(), \PDO::PARAM_INT);
        $query->execute();
    }
}
