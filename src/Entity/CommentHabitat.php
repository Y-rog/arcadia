<?php

namespace App\Entity;

use DateTime;
use App\Repository\UserRepository;
use App\Repository\HabitatRepository;


class CommentHabitat extends Entity
{
    protected ?int $id = null;
    protected string $content = '';
    protected DateTime $created_at;
    protected string $habitatId = '';
    protected string $userId = '';


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of comment
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of habitatId
     */
    public function getHabitatId()
    {
        return $this->habitatId;
    }

    /**
     * Set the value of habitatId
     *
     * @return  self
     */
    public function setHabitatId($habitatId)
    {
        $this->habitatId = $habitatId;

        return $this;
    }


    /**
     * Get the value of user_id
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }
    public function getHabitatName(): string
    {
        $habitatRepository = new HabitatRepository();
        $habitat = $habitatRepository->findOneById($this->habitatId);
        return $habitat->getName();
    }

    public function getUserFistName(): string
    {
        $userRepository = new UserRepository();
        $user = $userRepository->findOneById($this->userId);
        return $user->getFirstname();
    }

    public function getUserLastName(): string
    {
        $userRepository = new UserRepository();
        $user = $userRepository->findOneById($this->userId);
        return $user->getLastName();
    }
}
