<?php

namespace App\Entity;

use DateTime;
use App\Repository\UserRepository;
use App\Repository\AnimalRepository;

class ReviewVeterinary extends Entity
{
    protected ?int $id = null;
    protected string $health_status = '';
    protected string $food = '';
    protected string $food_quantity = '';
    protected DateTime $passing_date;
    protected string $health_status_details = '';
    protected string $animalUuid = '';
    protected int $userId = 0;

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

    public function getPassingDate(): DateTime
    {
        return $this->passing_date;
    }
    public function setPassingDate(DateTime $passing_date): self
    {
        $this->passing_date = $passing_date;
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

    public function getAnimalUuid(): string
    {
        return $this->animalUuid;
    }
    public function setAnimalUuid($animalUuid): self
    {
        $this->animalUuid = $animalUuid;
        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
    public function setUserId($userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getAnimalFirstName(): string
    {
        $animalRepository = new AnimalRepository();
        $animal = $animalRepository->findOneByUuid($this->animalUuid);
        return $animal->getFirstName();
    }

    public function getAnimalRace(): string
    {
        $animalRepository = new AnimalRepository();
        $animal = $animalRepository->findOneByUuid($this->animalUuid);
        return $animal->getRace();
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
