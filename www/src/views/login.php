<?php
/** @var $model \App\models\User */

use App\core\Application;
use App\core\Model;

?>

<div>
    <h1>Login</h1>

    <?php $form = \App\core\form\Form::begin("", "post") ?>
        <?= $form->input($model, 'email') ?>
        <?= $form->input($model, 'password')->passwordField() ?>
        <p><a style="text-decoration:none" href="/recover-password">Forgot password?</a></p>
        <button class="button" type="submit">Login</button>
    <?= App\core\form\Form::end() ?>
</div> 