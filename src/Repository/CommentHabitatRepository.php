<?php

namespace App\Repository;

use App\Entity\CommentHabitat;

class CommentHabitatRepository extends Repository
{
    public function insert(CommentHabitat $commentHabitat)
    {
        $query = $this->pdo->prepare('INSERT INTO comment_habitat (content, passing_date, habitat_id, user_id) VALUES (:content, :passing_date, :habitat_id, :user_id)');
        $query->bindValue(':content', $commentHabitat->getContent(), \PDO::PARAM_STR);
        $query->bindValue(':passing_date', $commentHabitat->getPassingDate()->format('Y-m-d'), \PDO::PARAM_STR);
        $query->bindValue(':habitat_id', $commentHabitat->getHabitatId(), \PDO::PARAM_INT);
        $query->bindValue(':user_id', $commentHabitat->getUserId(), \PDO::PARAM_INT);
        $query->execute();
    }

    public function findOneById(int $id): ?CommentHabitat
    {
        $query = $this->pdo->prepare('SELECT * FROM comment_habitat WHERE id = :id');
        $query->bindValue(':id', $id, \PDO::PARAM_INT);
        $query->execute();
        $commentHabitat = $query->fetch();
        if ($commentHabitat) {
            return CommentHabitat::createAndHydrate($commentHabitat);
        }
        return null;
    }

    public function findAll(): array
    {
        $query = $this->pdo->prepare('SELECT * FROM comment_habitat ORDER BY passing_date DESC');
        $query->execute();
        $commentHabitats = $query->fetchAll();
        $commentHabitats = array_map(function ($commentHabitat) {
            return CommentHabitat::createAndHydrate($commentHabitat);
        }, $commentHabitats);
        return $commentHabitats;
    }

    //voir les 10 derniers commentaires
    public function findLastCommentsHabitat()
    {
        $query = $this->pdo->prepare('SELECT * FROM comment_habitat ORDER BY passing_date DESC LIMIT 10');
        $query->execute();
        $commentHabitats = $query->fetchAll();
        $commentHabitats = array_map(function ($commentHabitat) {
            return CommentHabitat::createAndHydrate($commentHabitat);
        }, $commentHabitats);
        return $commentHabitats;
    }
}
