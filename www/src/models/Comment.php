<?php

namespace App\models;

use App\core\ORM;

class Comment extends ORM
{
    protected int $id = -1;
    protected int $page_id ;
    protected string $comment_name= '';
    protected string $comment_email = '';
    protected string $comment_text = '';
    protected string $comment_status = '';
    protected $date_inserted;
    protected $date_updated;


    public function rules(): array
    {
 
        return [
            'comment_name' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 100]],
            'comment_email' => [self::RULE_REQUIRED, [self::RULE_MAX, 'max' => 150]],
            'comment_text' => [self::RULE_REQUIRED, [self::RULE_TEXT, 'text' => 'comment_text']],
        ];
    }

    public function labels(): array
    {
        return [
            'comment_name' => 'Name',
            'comment_email' => 'Email',
            'comment_text' => 'Your comment',
        ];
    }



    public function saveData (){
        
        if (!$this->getOneBy('id', $this->getId())) {
            // C'est un nouvel enregistrement
            $this->setCommentName($this->getCommentName());
            $this->setCommentEmail($this->getCommentEmail());
            $this->setCommentText($this->getCommentText());

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
     * Get the value of comment_name
     */
    public function getCommentName(): string
    {
        return $this->comment_name;
    }

    /**
     * Set the value of comment_name
     */
    public function setCommentName(string $comment_name): self
    {
        $this->comment_name = $comment_name;

        return $this;
    }

    /**
     * Get the value of comment_email
     */
    public function getCommentEmail(): string
    {
        return $this->comment_email;
    }

    /**
     * Set the value of comment_email
     */
    public function setCommentEmail(string $comment_email): self
    {
        $this->comment_email = $comment_email;

        return $this;
    }

    /**
     * Get the value of comment_text
     */
    public function getCommentText(): string
    {
        return $this->comment_text;
    }

    /**
     * Set the value of comment_text
     */
    public function setCommentText(string $comment_text): self
    {
        $this->comment_text = $comment_text;

        return $this;
    }

    /**
     * Get the value of comment_status
     */
    public function getCommentStatus(): string
    {
        return $this->comment_status;
    }

    /**
     * Set the value of comment_status
     */
    public function setCommentStatus(string $comment_status): self
    {
        $this->comment_status = $comment_status;

        return $this;
    }

    /**
     * Get the value of date_inserted
     */
    public function getDateInserted()
    {
        return $this->date_inserted;
    }

    /**
     * Set the value of date_inserted
     */
    public function setDateInserted($date_inserted): self
    {
        $this->date_inserted = $date_inserted;

        return $this;
    }

    /**
     * Get the value of date_updated
     */
    public function getDateUpdated()
    {
        return $this->date_updated;
    }

    /**
     * Set the value of date_updated
     */
    public function setDateUpdated($date_updated): self
    {
        $this->date_updated = $date_updated;

        return $this;
    }
}