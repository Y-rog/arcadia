<?php

namespace App\Entity;

use DateTime;
use App\Repository\UserRepository;
use App\Repository\AnimalRepository;

class FoodConsumption extends Entity
{
    protected ?int $id = null;
    protected string $food_given = '';
    protected string $food_quantity = '';
    protected DateTime $give_at;
    protected string $animal_uuid = '';
    protected string $user_id = '';

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
     * Get the value of food_given
     */
    public function getFoodGiven()
    {
        return $this->food_given;
    }
    /**
     * Set the value of food_given
     *
     * @return  self
     */
    public function setFoodGiven($food_given)
    {
        $this->food_given = $food_given;

        return $this;
    }
    /**
     * Get the value of food_quantity
     */
    public function getFoodQuantity()
    {
        return $this->food_quantity;
    }
    /**
     * Set the value of food_quantity
     *
     * @return  self
     */
    public function setFoodQuantity($food_quantity)
    {
        $this->food_quantity = $food_quantity;

        return $this;
    }
    /**
     * Get the value of food_date
     */
    public function getGiveAt(): DateTime
    {
        return $this->give_at;
    }
    /**
     * Set the value of food_date
     *
     * @return  self
     */
    public function setGiveAt(DateTime $give_at)
    {
        $this->give_at = $give_at;

        return $this;
    }

    /**
     * Get the value of animal_uuid
     */
    public function getAnimalUuid()
    {
        return $this->animal_uuid;
    }
    /**
     * Set the value of animal_uuid
     *
     * @return  self
     */
    public function setAnimalUuid($animal_uuid)
    {
        $this->animal_uuid = $animal_uuid;

        return $this;
    }
    /**
     * Get the value of user_id
     */
    public function getUserId()
    {
        return $this->user_id;
    }
    /**
     * Set the value of user_id
     *
     * @return  self
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getUserFirstName()
    {
        $userRepository = new UserRepository();
        $user = $userRepository->findOneById($this->user_id);
        return $user->getFirstName();
    }

    public function getUserLastName()
    {
        $userRepository = new UserRepository();
        $user = $userRepository->findOneById($this->user_id);
        return $user->getLastName();
    }
}
