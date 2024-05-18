<?php

namespace App\Entity;

use App\Repository\ReviewVeterinaryRepository;

class Animal extends Entity
{
    protected ?string $uuid = '';
    protected ?string $first_name = '';
    protected ?string $race = '';
    protected ?string $image = '';
    protected ?int $habitatId = 0;

    /**
     * Get the value of uuid
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * Set the value of uuid
     *
     * @return  self
     */
    public function setUuid($uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }


    /**
     * Get the value of firstname
     */
    public function getFirstname(): ?string
    {
        return $this->first_name;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Get the value of race
     */
    public function getRace(): ?string
    {
        return $this->race;
    }

    /**
     * Set the value of race
     *
     * @return  self
     */
    public function setRace($race): self
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */
    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of habitatId
     */
    public function getHabitatId(): ?int
    {
        return $this->habitatId;
    }

    /**
     * Set the value of habitatId
     *
     * @return  self
     */
    public function setHabitatId($habitatId): self
    {
        $this->habitatId = $habitatId;

        return $this;
    }

    public function getImagePath(): string
    {
        $conf = require _ROOTPATH_ . '/cloudinary_config.php';

        return 'https://res.cloudinary.com/' . $conf['cloudinary_cloud_name'] . '/image/upload/' . $this->getImage();
    }

    public function getHealthStatus(): string
    {
        $reviewVeterinaryRepository = new ReviewVeterinaryRepository();
        $reviewVeterinary = $reviewVeterinaryRepository->findLastReviewVeterinaryByAnimal($this->getUuId());
        if ($reviewVeterinary) {
            return $reviewVeterinary->getHealthStatus();
        }
        return '';
    }
}
