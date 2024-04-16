<?php

namespace App\Repository;

use App\Entity\User;
use App\Db\Mysql;
use App\Tools\StringTools;

class UserRepository extends Repository
{
    public function findOneById(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM user WHERE id = :id");
        $query->bindParam(':id', $id, $this->pdo::PARAM_STR);
        $query->execute();
        $user = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($user) {
            return User::createAndHydrate($user);;
        } else {
            return false;
        }
    }

    public function findOneByEmail(string $email)
    {

        $query = $this->pdo->prepare("SELECT * FROM user WHERE email = :email");
        $query->bindParam(':email', $email, $this->pdo::PARAM_STR);
        $query->execute();
        $user = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($user) {
            return User::createAndHydrate($user);
        } else {
            return false;
        }
    }

    public function insert(User $user)
    {
        if ($user->getId() === null) {
            $query = $this->pdo->prepare("INSERT INTO user (email, password, first_name, last_name, role) VALUES (:email, :password, :first_name, :last_name, :role)");
            $query->bindValue(':email', $user->getEmail(), $this->pdo::PARAM_STR);
            $query->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT), $this->pdo::PARAM_STR);
            $query->bindValue(':first_name', $user->getFirstName(), $this->pdo::PARAM_STR);
            $query->bindValue(':last_name', $user->getLastName(), $this->pdo::PARAM_STR);
            $query->bindValue(':role', $user->getRole(), $this->pdo::PARAM_STR);
            $query->execute();
        } else {
            $query = $this->pdo->prepare("UPDATE user SET email = :email, password = :password, first_name = :first_name, last_name = :last_name, role = :role WHERE id = :id");
            $query->bindValue(':email', $user->getEmail(), $this->pdo::PARAM_STR);
            $query->bindValue(':password', password_hash($user->getPassword(), PASSWORD_DEFAULT), $this->pdo::PARAM_STR);
            $query->bindValue(':first_name', $user->getFirstName(), $this->pdo::PARAM_STR);
            $query->bindValue(':last_name', $user->getLastName(), $this->pdo::PARAM_STR);
            $query->bindValue(':role', $user->getRole(), $this->pdo::PARAM_STR);
            $query->bindValue(':id', $user->getId(), $this->pdo::PARAM_INT);
            $query->execute();
        }
    }

    public function delete(User $user)
    {
        $query = $this->pdo->prepare("DELETE FROM user WHERE id = :id");
        $query->bindValue(':id', $user->getId(), $this->pdo::PARAM_INT);
        $query->execute();
    }
}
