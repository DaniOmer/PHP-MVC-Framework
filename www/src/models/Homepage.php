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

class Homepage extends ORM
{
    protected int $id = -1;
    protected int $page_id ;
    protected string $banner_link = '';
    protected string $banner_text = '';
    protected string $content = '';
    protected $date_inserted;
    protected $date_updated;


    public function rules(): array
    {
 
        return [
            'banner_link' => [self::RULE_REQUIRED, [self::RULE_LINK, 'link' => 'banner_link']],
            'banner_text' => [self::RULE_REQUIRED, [self::RULE_TEXT, 'text' => 'banner_text']],
            'content' => [self::RULE_REQUIRED, [self::RULE_TEXT, 'text' => 'content']],
        ];
    }

    public function labels(): array
    {
        return [
            'banner_link' => 'Banner image link',
            'banner_text' => 'Banner text',
            'content' => 'Content',
        ];
    }



    public function saveData (){
        
        if (!$this->getOneBy('id', $this->getId())) {
            // C'est un nouvel enregistrement
            $this->setBannerLink($this->getBannerLink());
            $this->setBannerText($this->getBannerText());
            $this->setContent($this->getContent());

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
     * Get the value of title
     */
    public function getBannerLink(): string
    {
        return $this->banner_link;
    }

    /**
     * Set the value of title
     */
    public function setBannerLink(string $bannerLink): self
    {
        $this->banner_link = $bannerLink;

        return $this;
    }

    /**
     * Get the value of template
     */
    public function getBannerText(): string
    {
        return $this->banner_text;
    }

    /**
     * Set the value of template
     */
    public function setBannerText(string $bannerText): self
    {
        $this->banner_text = $bannerText;

        return $this;
    }

    /**
     * Get the value of pageUri
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Set the value of pageUri
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

}