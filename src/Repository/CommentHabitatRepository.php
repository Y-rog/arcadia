<?php

namespace App\Repository;

use App\Entity\CommentHabitat;

class CommentHabitatRepository extends Repository
{
    public function insert(CommentHabitat $commentHabitat)
    {
        $query = $this->pdo->prepare('INSERT INTO comment_habitat (content, created_at, habitat_id, user_id) VALUES (:content, :created_at, :habitat_id, :user_id)');
        $query->bindValue(':content', $commentHabitat->getContent(), \PDO::PARAM_STR);
        $query->bindValue(':created_at', $commentHabitat->getCreatedAt()->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
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
        $query = $this->pdo->prepare('SELECT * FROM comment_habitat ORDER BY created_at DESC');
        $query->execute();
        $commentHabitats = $query->fetchAll();
        $commentHabitats = array_map(function ($commentHabitat) {
            return CommentHabitat::createAndHydrate($commentHabitat);
        }, $commentHabitats);
        return $commentHabitats;
    }
}
