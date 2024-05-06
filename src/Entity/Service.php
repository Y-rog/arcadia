<?php

namespace App\Entity;

use DateTime;


class Service extends Entity
{
    protected ?int $id = null;
    protected string $title = '';
    protected string $description = '';
    protected DateTime $updated_at;
    protected ?int $user_id = null;

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
     * Get the value of title
     */
    public function getTitle(): string
    {
        return $this->title;
    }
    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title): self
    {
        $this->title = $title;

        return $this;
    }
    /**
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }
    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description): self
    {
        $this->description = $description;

        return $this;
    }
    /**
     * Get the value of updated_at
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }
    /**
     * Set the value of updated_at
     *
     * @return  self
     */
    public function setUpdatedAt(DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
    /**
     * Get the value of user_id
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }
    /**
     * Set the value of uder_id
     *
     * @return  self
     */
    public function setUserId($user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
