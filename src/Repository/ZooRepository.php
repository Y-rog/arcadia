<?php

namespace App\Repository;

use App\Entity\Zoo;

class ZooRepository extends Repository
{
    public function updateSchedules(Zoo $zoo)
    {
        $query = $this->pdo->prepare("UPDATE zoo SET schedules = :schedules WHERE id = 1");
        $query->bindValue(':schedules', $zoo->getSchedules(), $this->pdo::PARAM_STR);
        $query->execute();
        return $this->pdo->lastInsertId();
    }

    public function findZoo()
    {
        $query = $this->pdo->prepare("SELECT * FROM zoo WHERE id = 1");
        $query->execute();
        $zoo = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($zoo) {
            return Zoo::createAndHydrate($zoo);
        } else {
            return false;
        }
    }
}
