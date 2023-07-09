<?php

                   
/*
 * Copyright (c) 2023 by Hind SEDRATI
 * 
 *
 * File name: www/src/models/Homepage.php
 * Creation date: 2023-07-09 04:09:27
 * Autor: Hind SEDRATI
 *
 * Last Modified: 4959ca7 2023-07-03 13:58:21
 */

namespace App\models;

use App\core\ORM;

class Blog extends ORM
{
    protected int $id = -1;
    protected int $page_id ;
    protected string $blog_title = '';
    protected string $first_sub_title = '';
    protected string $second_sub_title = '';
    protected string $third_sub_title = '';
    protected string $first_paragraph = '';
    protected string $second_paragraph = '';
    protected string $third_paragraph = '';
    protected string $comment_section = '';
    protected $date_inserted;
    protected $date_updated;


    public function rules(): array
    {
 
        return [
            'blog_title' => [self::RULE_REQUIRED, [self::RULE_TEXT, 'text' => 'first_sub_title'], [self::RULE_MAX, 'max' => 350]],
            'first_sub_title' => [self::RULE_REQUIRED, [self::RULE_TEXT, 'text' => 'first_sub_title'], [self::RULE_MAX, 'max' => 250]],
            'second_sub_title' => [self::RULE_REQUIRED, [self::RULE_TEXT, 'text' => 'second_sub_title'], [self::RULE_MAX, 'max' => 250]],
            'third_sub_title' => [self::RULE_REQUIRED, [self::RULE_TEXT, 'text' => 'third_sub_title'], [self::RULE_MAX, 'max' => 250]],
            'first_paragraph' => [self::RULE_REQUIRED, [self::RULE_TEXT, 'text' => 'first_paragraph']],
            'second_paragraph' => [self::RULE_REQUIRED, [self::RULE_TEXT, 'text' => 'second_paragraph']],
            'third_paragraph' => [self::RULE_REQUIRED, [self::RULE_TEXT, 'text' => 'third_paragraph']],
            'comment_section' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'blog_title' => 'Title',
            'first_sub_title' => 'Subtitle 1',
            'second_sub_title' => 'Subtitle 1',
            'third_sub_title' => 'Subtitle 1',
            'first_paragraph' => 'Paragraph 1',
            'second_paragraph' => 'Paragraph 2',
            'third_paragraph' => 'Paragraph 3',
            'comment_section' => 'Comment section',
        ];
    }



    public function saveData (){
        
        if (!$this->getOneBy('id', $this->getId())) {
            // C'est un nouvel enregistrement
            $this->setBlogTitle($this->getBlogTitle());
            $this->setFirstSubTitle($this->getFirstSubTitle());
            $this->setThirdSubTitle($this->getThirdSubTitle());
            $this->setSecondSubTitle($this->getSecondSubTitle());
            $this->setFirstParagraph($this->getFirstParagraph());
            $this->setSecondParagraph($this->getSecondParagraph());
            $this->setThirdParagraph($this->getThirdParagraph());
            $this->setCommentSection($this->getCommentSection());

            $currentTimestamp = time();
            $this->date_inserted = date('Y-m-d H:i:s', $currentTimestamp);
            $this->date_updated = date('Y-m-d H:i:s', $currentTimestamp);
        } else {
            // Ce n'est pas un nouvel enregistrement, mettez uniquement à jour la propriété date_updated
            $this->date_updated = date('Y-m-d H:i:s', time());
        }
        return parent::save();
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function __toString(): string
    {
        return serialize($this);
    }

    public function isNewRecord()
    {
        return $this->isNewRecord;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
        $this->isNewRecord = ($id <= 0);
    }

    /**
     * @return int
     */
    public function getPageId(): int
    {
        return $this->page_id;
    }

    public function setPageId(int $pageId): void
    {
        $this->page_id = $pageId;
    }

    /**
     * Get the value of blog_title
     */
    public function getBlogTitle(): string
    {
        return $this->blog_title;
    }

    /**
     * Set the value of blog_title
     */
    public function setBlogTitle(string $blog_title): self
    {
        $this->blog_title = $blog_title;

        return $this;
    }

    /**
     * Get the value of first_sub_title
     */
    public function getFirstSubTitle(): string
    {
        return $this->first_sub_title;
    }

    /**
     * Set the value of first_sub_title
     */
    public function setFirstSubTitle(string $first_sub_title): self
    {
        $this->first_sub_title = $first_sub_title;

        return $this;
    }

    /**
     * Get the value of second_sub_title
     */
    public function getSecondSubTitle(): string
    {
        return $this->second_sub_title;
    }

    /**
     * Set the value of second_sub_title
     */
    public function setSecondSubTitle(string $second_sub_title): self
    {
        $this->second_sub_title = $second_sub_title;

        return $this;
    }

    /**
     * Get the value of third_sub_title
     */
    public function getThirdSubTitle(): string
    {
        return $this->third_sub_title;
    }

    /**
     * Set the value of third_sub_title
     */
    public function setThirdSubTitle(string $third_sub_title): self
    {
        $this->third_sub_title = $third_sub_title;

        return $this;
    }

    /**
     * Get the value of first_paragraph
     */
    public function getFirstParagraph(): string
    {
        return $this->first_paragraph;
    }

    /**
     * Set the value of first_paragraph
     */
    public function setFirstParagraph(string $first_paragraph): self
    {
        $this->first_paragraph = $first_paragraph;

        return $this;
    }

    /**
     * Get the value of second_paragraph
     */
    public function getSecondParagraph(): string
    {
        return $this->second_paragraph;
    }

    /**
     * Set the value of second_paragraph
     */
    public function setSecondParagraph(string $second_paragraph): self
    {
        $this->second_paragraph = $second_paragraph;

        return $this;
    }

    /**
     * Get the value of third_paragraph
     */
    public function getThirdParagraph(): string
    {
        return $this->third_paragraph;
    }

    /**
     * Set the value of third_paragraph
     */
    public function setThirdParagraph(string $third_paragraph): self
    {
        $this->third_paragraph = $third_paragraph;

        return $this;
    }


    /**
     * Get the value of third_paragraph
     */
    public function getCommentSection(): string
    {
        return $this->comment_section;
    }

    /**
     * Set the value of third_paragraph
     */
    public function setCommentSection(string $comment_section): self
    {
        $this->comment_section = $comment_section;

        return $this;
    }

    
}