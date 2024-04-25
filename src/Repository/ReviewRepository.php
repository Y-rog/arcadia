<?php

namespace App\Repository;

use App\Entity\Review;
use App\Security\Security;

class ReviewRepository extends Repository
{

    public function count()
    {
        // On compte le nombre d'avis
        if (Security::isAdmin() | Security::isEmployee()) {
            $query = $this->pdo->query('SELECT COUNT(id) FROM review');
            return (int)$query->fetch($this->pdo::FETCH_NUM)[0];
        } else {
            $query = $this->pdo->query('SELECT COUNT(id) FROM review WHERE is_validated = 1');
            return (int)$query->fetch($this->pdo::FETCH_NUM)[0];
        }
    }

    public function showPageReviews($currentPage, $perPage)
    {
        if (Security::isAdmin() | Security::isEmployee()) {
            /* OFFSET: On calcule les articles à afficher ex:page 1 => artciles de 0 à 10 page 2 => articles de 10 à 20*/
            // On récupère les articles par pages
            $query = $this->pdo->query('SELECT * FROM review ORDER BY created_at DESC LIMIT ' . $perPage . ' OFFSET ' . ($currentPage - 1) * $perPage);
        } else {
            $query = $this->pdo->query('SELECT * FROM review WHERE is_validated = 1 ORDER BY created_at DESC LIMIT ' . $perPage . ' OFFSET ' . ($currentPage - 1) * $perPage);
        }
        $reviews = $query->fetchAll($this->pdo::FETCH_ASSOC);
        //On hydrate les articles
        $reviewEntities = [];
        if ($reviews) {
            foreach ($reviews as $review) {
                $reviewEntities[] = Review::createAndHydrate($review);
            }
        }
        return $reviewEntities;
    }

    public function insert(Review $review)
    {
        $query = $this->pdo->prepare('INSERT INTO review (user_name, content) VALUES (:user_name, :content)');
        $query->bindValue(':user_name', $review->getUserName(), $this->pdo::PARAM_STR);
        $query->bindValue(':content', $review->getContent(), $this->pdo::PARAM_STR);
        $query->execute();
    }

    public function findOnebyId($id)
    {
        $query = $this->pdo->prepare('SELECT * FROM review WHERE id = :id');
        $query->bindValue(':id', $id, $this->pdo::PARAM_INT);
        $query->execute();
        $review = $query->fetch($this->pdo::FETCH_ASSOC);
        if ($review) {
            return Review::createAndHydrate($review);
        }
        return null;
    }

    public function findReviewHomePage()
    {
        $query = $this->pdo->query('SELECT * FROM review WHERE on_home_page = 1');
        $reviews = $query->fetchAll($this->pdo::FETCH_ASSOC);
        $reviewEntities = [];
        if ($reviews) {
            foreach ($reviews as $review) {
                $reviewEntities[] = Review::createAndHydrate($review);
            }
        }
        return $reviewEntities;
    }

    public function validateReview(Review $review)
    {
        $query = $this->pdo->prepare('UPDATE review SET is_validated = 1 WHERE id = :id');
        $query->bindValue(':id', $review->getId(), $this->pdo::PARAM_INT);
        return $query->execute();
    }

    public function unvalidate(Review $review)
    {
        $query = $this->pdo->prepare('UPDATE review SET is_validated = 0 WHERE id = :id');
        $query->bindValue(':id', $review->getId(), $this->pdo::PARAM_INT);
        return $query->execute();
    }

    public function favorite(Review $review)
    {
        $query = $this->pdo->prepare('UPDATE review SET on_home_page = 1 WHERE id = :id');
        $query->bindValue(':id', $review->getId(), $this->pdo::PARAM_INT);
        return $query->execute();
    }

    public function unfavorite(Review $review)
    {
        $query = $this->pdo->prepare('UPDATE review SET on_home_page = 0 WHERE id = :id');
        $query->bindValue(':id', $review->getId(), $this->pdo::PARAM_INT);
        return $query->execute();
    }



    public function delete(Review $review)
    {
        $query = $this->pdo->prepare('DELETE FROM review WHERE id = :id');
        $query->bindValue(':id', $review->getId(), $this->pdo::PARAM_INT);
        $query->execute();
    }
}
