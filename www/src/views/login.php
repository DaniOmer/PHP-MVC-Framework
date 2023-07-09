<?php
/** @var $model \App\models\User */

use App\core\Application;
use App\core\Model;

?>

<div style="width:40%; margin:0 auto;">
    <h1>Login</h1>

    <?php $form = \App\core\form\Form::begin("", "post") ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password')->passwordField() ?>
        <p style="text-align:right"><a style="text-decoration:none" href="/recover-password">Forgot password?</a></p>
        <button style="padding:5px; margin-top:10px" type="submit">Login</button>
    <?= App\core\form\Form::end() ?>
</div>