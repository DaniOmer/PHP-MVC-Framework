<?php 
namespace App\models;
class Theme {
    private int $id;
    private string $name;
    private string $font_familly;
    private string $primary_color;
    private string $secondary_color;
    private string $background_color;

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
     * Get the value of font_familly
     */
    public function getFontFamilly(): string
    {
        return $this->font_familly;
    }

    /**
     * Set the value of font_familly
     */
    public function setFontFamilly(string $font_familly): self
    {
        $this->font_familly = $font_familly;

        return $this;
    }

    /**
     * Get the value of primary_color
     */
    public function getPrimaryColor(): string
    {
        return $this->primary_color;
    }

    /**
     * Set the value of primary_color
     */
    public function setPrimaryColor(string $primary_color): self
    {
        $this->primary_color = $primary_color;

        return $this;
    }

    /**
     * Get the value of secondary_color
     */
    public function getSecondaryColor(): string
    {
        return $this->secondary_color;
    }

    /**
     * Set the value of secondary_color
     */
    public function setSecondaryColor(string $secondary_color): self
    {
        $this->secondary_color = $secondary_color;

        return $this;
    }

    /**
     * Get the value of background_color
     */
    public function getBackgroundColor(): string
    {
        return $this->background_color;
    }

    /**
     * Set the value of background_color
     */
    public function setBackgroundColor(string $background_color): self
    {
        $this->background_color = $background_color;

        return $this;
    }
}