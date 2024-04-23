<?php

namespace App\Entity;

class Animal extends Entity
{
    protected ?int $id = null;
    protected string $first_name = '';
    protected string $race = '';
    protected string $image = '';
    protected string $habitatId = '';

    /**
     * Get the value of id
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id): self
    {
        $this->id = $id;

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
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set the value of race
     *
     * @return  self
     */
    public function setRace($race)
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

    public function getImagePath()
    {
        return _IMAGE_ANIMAL_ . $this->getImage();
    }
}
