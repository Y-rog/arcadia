<?php

namespace App\Entity;

use DateTime;


class Review extends Entity
{
    protected ?int $id = null;
    protected ?string $user_name = '';
    protected ?string $content = '';
    protected DateTime $created_at;
    protected ?bool $is_validated = false;
    protected ?bool $on_home_page = false;

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
     * Get the value of user_name
     */
    public function getUserName(): string
    {
        return $this->user_name;
    }

    /**
     * Set the value of user_name
     *
     * @return  self
     */
    public function setUserName($user_name): self
    {
        $this->user_name = $user_name;

        return $this;
    }

    /**
     * Get the value of content
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */
    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreatedAt(DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of is_validated
     */
    public function getIsValidated(): bool
    {
        return $this->is_validated;
    }

    /**
     * Set the value of is_validated
     *
     * @return  self
     */
    public function setIsValidated($is_validated): self
    {
        $this->is_validated = $is_validated;

        return $this;
    }

    /**
     * Get the value of is_validated
     */
    public function getOnHomePage(): bool
    {
        return $this->on_home_page;
    }

    /**
     * Set the value of is_validated
     *
     * @return  self
     */
    public function setOnHomePage($on_home_page): self
    {
        $this->on_home_page = $on_home_page;

        return $this;
    }
}
