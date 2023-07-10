<?php
/** @var $model \App\models\ResetPasswordForm */

use App\core\Application;
use App\core\Model;

?>

<div>
    <h1>Enter your email address</h1>

    <?php $form = \App\core\form\Form::begin("", "post") ?>
        <?= $form->input($model, 'currentPassword')->passwordField() ?>
        <div>
            <?= $form->input($model, 'password')->passwordField() ?>
            <?= $form->input($model, 'confirmPassword')->passwordField() ?>
        </div>
        <button class="button" type="submit">Submit</button>
    <?= App\core\form\Form::end() ?>
</div> 