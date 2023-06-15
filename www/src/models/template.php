<?php 

namespace App\models;

class Template extends ORM{
    private int $id;
    private int $page_id;
    private string $file_path;
    private string $name;
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
     * Get the value of file_path
     */
    public function getFilePath(): string
    {
        return $this->file_path;
    }

    /**
     * Set the value of file_path
     */
    public function setFilePath(string $file_path): self
    {
        $this->file_path = $file_path;

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