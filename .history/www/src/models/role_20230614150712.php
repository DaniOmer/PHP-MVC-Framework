<?php

namespace App\models;

class Role {

    private int $id;
    private string $name;
    private string $description;
    private string $created_at;
    private string $updated_at;

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

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
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of created_id
     */
    public function getCreatedat(): string
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_id
     */
    public function setCreatedat(string $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated
     */
    public function getUpdated(): string
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated
     */
    public function setUpdated(string $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}