<?php
/** @var $model \App\models\RecoverPasswordForm */

use App\core\Application;
use App\core\Model;

?>

<div style="width:40%; margin:0 auto;">
    <h1>Enter your email address</h1>

    <?php $form = \App\core\form\Form::begin("", "post") ?>
        <?= $form->input($model, 'email') ?>
        <button class="button" type="submit">Submit</button>
    <?= App\core\form\Form::end() ?>
</div> 