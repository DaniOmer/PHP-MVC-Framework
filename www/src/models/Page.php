<?php

namespace App\models;

use App\core\Application;
use App\core\Model;
use App\core\ORM;

class Page extends ORM
{
    protected int $id = -1;
    protected int $user_id ;
    protected string $title = '';
    protected string $sub_title = '';
    protected string $content = '';
    protected string $page_uri = '';
    protected string $seo_title = '';
    protected string $seo_keywords = '';
    protected string $seo_description = '';
    protected $date_inserted;
    protected $date_updated;


    public function rules(): array
    {

        return [
            'seo_title' => [self::RULE_REQUIRED],
            'seo_keywords' => [self::RULE_REQUIRED],
            'seo_description' => [self::RULE_REQUIRED],
            'title' => [self::RULE_REQUIRED],
            'sub_title' => [self::RULE_REQUIRED],
            'content' => [self::RULE_REQUIRED],
            'page_uri' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'seo_title' => 'SEO Title',
            'seo_keywords' => 'SEO Keywords',
            'seo_description' => 'SEO Description',
            'title' => 'Page title',
            'sub_title' => 'Page subtitle',
            'content' => 'Page content',
            'page_uri' => 'Page URI',
        ];
    }



    public function saveData (){
        
        if (!$this->getOneBy('id', $this->getId())) {
            // C'est un nouvel enregistrement
            $this->setUserId(Application::$app->user->getId());
            $this->setTitle($this->getTitle());
            $this->setSubTitle($this->getSubTitle());
            $this->setContent($this->getContent());
            $this->setPageUri($this->getPageUri());
            $this->setSeoTitle($this->getSeoTitle());
            $this->setSeoKeywords($this->getSeoKeywords());
            $this->setPageUri($this->getPageUri());

            $currentTimestamp = time();
            $this->date_inserted = date('Y-m-d H:i:s', $currentTimestamp);
            $this->date_updated = date('Y-m-d H:i:s', $currentTimestamp);
        } else {
            // Ce n'est pas un nouvel enregistrement, mettez uniquement à jour la propriété date_updated
            $this->date_updated = date('Y-m-d H:i:s', time());
        }
        return parent::save();
    }

    public static function getTable(): string
    {
        return "esgi_page";
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
    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $userId): void
    {
        $this->user_id = $userId;
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
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of subTitle
     */
    public function getSubTitle(): string
    {
        return $this->sub_title;
    }

    /**
     * Set the value of subTitle
     */
    public function setSubTitle(string $subTitle): self
    {
        $this->sub_title = $subTitle;

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
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of pageUri
     */
    public function getPageUri(): string
    {
        return $this->page_uri;
    }

    /**
     * Set the value of pageUri
     */
    public function setPageUri(string $page_uri): self
    {
        $this->page_uri = $page_uri;

        return $this;
    }

    /**
     * Get the value of seoTitle
     */
    public function getSeoTitle(): string
    {
        return $this->seo_title;
    }

    /**
     * Set the value of seoTitle
     */
    public function setSeoTitle(string $seo_title): self
    {
        $this->seo_title = ucwords(strtolower(trim($seo_title)));

        return $this;
    }

    /**
     * Get the value of seoKeywords
     */
    public function getSeoKeywords(): string
    {
        return $this->seo_keywords;
    }

    /**
     * Set the value of seoKeywords
     */
    public function setSeoKeywords(string $seo_keywords): self
    {
        $this->seo_keywords = $seo_keywords;

        return $this;
    }

    /**
     * Get the value of seoDescription
     */
    public function getSeoDescription(): string
    {
        return $this->seo_description;
    }

    /**
     * Set the value of seoDescription
     */
    public function setSeoDescription(string $seo_description): self
    {
        $this->seo_description = $seo_description;

        return $this;
    }
}