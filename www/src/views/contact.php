<?php

$this->title = 'Contact';
$this->description = 'Voici notre page de contact. Nous seront ravis de vous lire !';

?>
<div style="width:40%; margin:0 auto;">
    <h1>Contact us</h1>
    <?php $form = \App\core\form\Form::begin("/contact", 'post') ?>
        <?= $form->input($model, 'subject') ?>
        <?= $form->input($model, 'email') ?>
        <?= $form->textarea($model, 'body') ?>
        <button type="submit">Submit</button>
    <?php \App\core\form\Form::end() ?>
</div> 