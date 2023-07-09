<?php

/*
 * Copyright (c) 2023 by Hind SEDRATI
 * 
 *
 * File name: www/src/models/Card.php
 * Creation date: 2023-07-09 04:09:27
 * Autor: Hind SEDRATI
 *
 * Last Modified: 4959ca7 2023-07-03 13:58:21
 */

namespace App\models;
 
use App\core\Application;
use App\core\Model;
use App\core\ORM;

class Card extends ORM
{
    protected int $id = -1;
    protected int $template_id ;
    protected string $card_title = '';
    protected string $card_link = '';
    protected string $card_media_url = '';
    protected string $card_price = '';
    protected $date_inserted;
    protected $date_updated;


    public function rules(): array
    {

        return [
            'card_title' => [self::RULE_TEXT, 'text' => 'title'],
            'card_link' => [self::RULE_TEXT, 'text' => 'link'],
            'card_media_url' => [self::RULE_TEXT, 'text' => 'media_url'],
            'card_price' => [self::RULE_TEXT, 'text' => 'price'],
        ];
    }

    public function labels(): array
    {
        return [
            'card_title-0' => 'Card title',
            'card_link-0' => 'Card link',
            'card_media_url-0' => 'Image link',
            'card_price-0' => 'Card Price',
        ];
    }



    public function saveData (){
        
        if (!$this->getOneBy('id', $this->getId())) {
            // C'est un nouvel enregistrement
            $this->setCardTitle($this->getCardTitle());
            $this->setCardLink($this->getCardLink());
            $this->setCardPrice($this->getCardPrice());
            $this->setCardMediaUrl($this->getCardMediaUrl());

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
    public function getTemplateId(): int
    {
        return $this->template_id;
    }

    public function setTemplateId(int $templateId): void
    {
        $this->template_id = $templateId;
    }

    /**
     * Get the value of title
     */
    public function getCardTitle(): string
    {
        return $this->card_title;
    }

    /**
     * Set the value of title
     */
    public function setCardTitle(string $card_title): self
    {
        $this->card_title = $card_title;

        return $this;
    }

    /**
     * Get the value of template
     */
    public function getCardLink(): string
    {
        return $this->card_link;
    }

    /**
     * Set the value of template
     */
    public function setCardLink(string $card_link): self
    {
        $this->card_link = $card_link;

        return $this;
    }

    /**
     * Get the value of pageUri
     */
    public function getCardPrice(): string
    {
        return $this->card_price;
    }

    /**
     * Set the value of pageUri
     */
    public function setCardPrice(string $card_price): self
    {
        $this->card_price = $card_price;

        return $this;
    }

    /**
     * Get the value of pageUri
     */
    public function getCardMediaUrl(): string
    {
        return $this->card_media_url;
    }

    /**
     * Set the value of pageUri
     */
    public function setCardMediaUrl(string $card_media_url): self
    {
        $this->card_media_url = $card_media_url;

        return $this;
    }

}