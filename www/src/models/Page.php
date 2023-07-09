<?php

namespace App\models;

use App\core\Application;
use App\core\Model;
use App\core\ORM;

class Page extends ORM
{
    protected int $id = -1;
    protected int $user_id = -1 ;
    protected string $title = '';
    protected string $template = '';
    protected string $page_uri = '';
    protected string $seo_title = '';
    protected string $seo_keywords = '';
    protected string $seo_description = '';
    protected string $on_menu = '';
    protected $date_inserted;
    protected $date_updated;


    public function rules(): array
    {
        $currentUser = Application::$app->user;
        $pageOwnerId = $currentUser->getRole() === 'admin' ? $currentUser->getId() : $currentUser->getAdminId();

        // Check for update later
        $uniqueRule = ($this->getUserId() === $pageOwnerId || $this->isNewRecord())  ? [self::RULE_UNIQUE, 'class' => self::class] : '';

        return [
            'seo_title' => [self::RULE_REQUIRED, [self::RULE_TEXT, 'text' => 'seo_title']],
            'seo_keywords' => [self::RULE_REQUIRED, [self::RULE_TEXT, 'text' => 'seo_keywords']],
            'seo_description' => [self::RULE_REQUIRED, [self::RULE_TEXT, 'text' => 'seo_description']],
            'title' => [self::RULE_REQUIRED, $uniqueRule],
            'template' => [self::RULE_REQUIRED],
            'page_uri' => [self::RULE_REQUIRED, [self::RULE_TEXT, 'text' => 'page_uri'], $uniqueRule],
            'on_menu' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'seo_title' => 'SEO Title',
            'seo_keywords' => 'SEO Keywords',
            'seo_description' => 'SEO Description',
            'title' => 'Page title',
            'template' => 'Page template',
            'page_uri' => 'Page URI',
            'on_menu' => 'On menu'
        ];
    }



    public function saveData (){
        
        if (!$this->getOneBy('id', $this->getId())) {
            // C'est un nouvel enregistrement
            $this->setUserId(Application::$app->user->getId());
            $this->setTitle($this->getTitle());
            $this->setTemplate($this->getTemplate());
            $this->setPageUri($this->getPageUri());
            $this->setSeoTitle($this->getSeoTitle());
            $this->setSeoKeywords($this->getSeoKeywords());
            $this->setOnMenu($this->getOnMenu());


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
     * Get the value of template
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * Set the value of template
     */
    public function setTemplate(string $template): self
    {
        $this->template = $template;

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

    /**
     * Set the value of on_menu
     */
    public function setOnMenu(string $on_menu): self
    {
        $this->on_menu = $on_menu;

        return $this;
    }

    /**
     * Get the value of seoDescription
     */
    public function getOnMenu(): string
    {
        return $this->on_menu;
    }

}