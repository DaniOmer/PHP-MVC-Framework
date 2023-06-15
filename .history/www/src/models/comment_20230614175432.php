<?php

namespace App\models;


class Comment extends ORM {
    private int $id;
    private int $user_id; 
    private int $page_id;
    private string $comment;
    private string $is_moderated;
    private strin
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
     * Get the value of page_id
     */
    public function getPageId(): int
    {
        return $this->page_id;
    }

    /**
     * Set the value of page_id
     */
    public function setPageId(int $page_id): self
    {
        $this->page_id = $page_id;

        return $this;
    }

    /**
     * Get the value of comment
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     */
    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of is_moderated
     */
    public function getIsModerated(): string
    {
        return $this->is_moderated;
    }

    /**
     * Set the value of is_moderated
     */
    public function setIsModerated(string $is_moderated): self
    {
        $this->is_moderated = $is_moderated;

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
}