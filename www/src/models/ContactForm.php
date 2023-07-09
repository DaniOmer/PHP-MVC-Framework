<?php

namespace App\models;
 
use App\core\Model;

class ContactForm extends Model
{
    protected string $subject = '';
    protected string $email = '';
    protected string $body = '';

    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'body' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array
    {
        return [
            'subject' => 'Enter your subject',
            'email' => 'Your email',
            'body' => 'Your message',
        ];
    }

    public function send(){
        return true;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email ?? '';
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject ?? '';
    }

    /**
     * @param string $password
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body ?? '';
    }

    /**
     * @param string $password
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }
}