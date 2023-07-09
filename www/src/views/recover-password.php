<?php
/** @var $model \App\models\RecoverPasswordForm */

use App\core\Application;
use App\core\Model;

?>

<div style="width:40%; margin:0 auto;">
    <h1>Enter your email address</h1>

    <?php $form = \App\core\form\Form::begin("", "post") ?>
        <?= $form->input($model, 'email') ?>
        <button style="padding:5px; margin-top:10px" type="submit">Submit</button>
    <?= App\core\form\Form::end() ?>
</div>