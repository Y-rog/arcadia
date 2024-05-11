<?php

namespace App\Entity;

use DateTime;
use App\Repository\UserRepository;
use App\Repository\HabitatRepository;


class CommentHabitat extends Entity
{
    protected ?int $id = null;
    protected ?string $content = '';
    protected ?DateTime $passing_date = null;
    protected ?int $habitatId = 0;
    protected ?int $userId = 0;


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
    public function getPassingDate()
    {
        return $this->passing_date;
    }

    public function setPassingDate(DateTime $passing_date): self
    {
        $this->passing_date = $passing_date;
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
