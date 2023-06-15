<?php 

namespace App\models;

class Personnel_access_tokens {
    private int $id;
    private int $user_id;
    private string $token;
    private string $abilities;
    private string $created_at;
    private string $updated_at;
    private string $expire_at;



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
     * Get the value of user_id
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     */
    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of token
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Set the value of token
     */
    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of abilities
     */
    public function getAbilities(): string
    {
        return $this->abilities;
    }

    /**
     * Set the value of abilities
     */
    public function setAbilities(string $abilities): self
    {
        $this->abilities = $abilities;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     */
    public function setCreatedAt(string $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     */
    public function setUpdatedAt(string $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get the value of expire_at
     */
    public function getExpireAt(): string
    {
        return $this->expire_at;
    }

    /**
     * Set the value of expire_at
     */
    public function setExpireAt(string $expire_at): self
    {
        $this->expire_at = $expire_at;

        return $this;
    }
}