<?php

namespace App\Entity;

class Zoo extends Entity
{
    protected ?int $id = null;
    protected string $schedules = '';

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
     * Get the value of name
     */
    public function getSchedules(): ?string
    {
        return $this->schedules;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setSchedules($schedules): self
    {
        $this->schedules = $schedules;

        return $this;
    }
}
