<?php
/*
 * Copyright (c) 2023 by Hind SEDRATI
 * 
 *
 * File name: www/src/views/edit-page.php
 * Creation date: 2023-07-09 04:09:27
 * Autor: Hind SEDRATI
 *
 * Last Modified: 4959ca7 2023-07-03 13:58:21
 */

<section style="width:50%; margin:0 auto;">
    <h3>Here's the place to update your page</h3>
    <div>
        <?php $form = \App\core\form\Form::begin("", "post") ?>
            <?= $form->input($model, 'title')->setValue($title) ?>
            <?= $form->input($model, 'seo_title')->setValue($seo_title) ?>
            <?= $form->input($model, 'seo_keywords')->setValue($seo_keywords) ?>
            <?= $form->input($model, 'page_uri')->setValue($page_uri) ?>
            <?= $form->textarea($model, 'seo_description')->setValue($seo_description) ?>
            <?= $form->select($model, 'template', ['homepage' =>'Homepage', 'gallery' => 'Gallery', 'blog' => 'Blog'])->setValue($template) ?>
            <?= $form->select($model, 'on_menu', ['show' =>'Show', 'hide' => 'Hide'])->setValue($template) ?>
            <button style="padding:5px; margin-top:10px" type="submit">Save change</button>
        <?= App\core\form\Form::end() ?>
    </div>
</section> 