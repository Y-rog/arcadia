<?php

namespace App\Entity;

class ReviewVeterinary extends Entity
{
    protected ?int $id = null;
    protected string $health_status = '';
    protected string $food = '';
    protected string $food_quantity = '';
    protected string $created_at = '';
    protected string $health_status_details = '';
    protected string $animalId = '';
    protected string $userId = '';

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }
    public function getHealthStatus(): string
    {
        return $this->health_status;
    }
    public function setHealthStatus($health_status): self
    {
        $this->health_status = $health_status;
        return $this;
    }
    public function getFood(): string
    {
        return $this->food;
    }
    public function setFood($food): self
    {
        $this->food = $food;
        return $this;
    }
    public function getFoodQuantity(): string
    {
        return $this->food_quantity;
    }
    public function setFoodQuantity($food_quantity): self
    {
        $this->food_quantity = $food_quantity;
        return $this;
    }
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }
    public function setCreatedAt($created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }
    public function getHealthStatusDetails(): string
    {
        return $this->health_status_details;
    }
    public function setHealthStatusDetails($health_status_details): self
    {
        $this->health_status_details = $health_status_details;
        return $this;
    }
    public function getAnimalId(): string
    {
        return $this->animalId;
    }
    public function setAnimalId($animalId): self
    {
        $this->animalId = $animalId;
        return $this;
    }
    public function getUserId(): string
    {
        return $this->userId;
    }
    public function setUserId($userId): self
    {
        $this->userId = $userId;
        return $this;
    }
}
