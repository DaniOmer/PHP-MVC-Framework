/*
 * Copyright (c) 2023 by Hind SEDRATI
 * 
 *
 * File name: www/src/views/homepage-form.php
 * Creation date: 2023-07-09 04:09:27
 * Autor: Hind SEDRATI
 *
 * Last Modified: 4959ca7 2023-07-03 13:58:21
 */
    <h3>Let's design your home page</h3>
    <div>
        <?php $form = \App\core\form\Form::begin("", "post") ?>
            <?= $form->input($model, 'banner_link') ?>
            <?= $form->input($model, 'banner_text') ?>
            <?= $form->input($model, 'content') ?>
            <button style="padding:5px; margin-top:10px" type="submit">Save</button>
        <?= App\core\form\Form::end() ?>
    </div>
</section>
