<?php

namespace App\models;

use App\core\Model;

class PageForm extends Model
{
    protected string $seo_title = '';
    protected array $seo_keywords = [];
    protected string $seo_description = '';
    protected string $title = '';
    protected string $sub_title = '';
    protected string $content = '';
    protected string $page_uri = '';


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


    
}