<?php

use App\core\Application;

$firstname = Application::$app->user->getFirstname();
$lastname = Application::$app->user->getLastname();
$email = Application::$app->user->getEmail();
$password = Application::$app->user->getPassword();

?>

<section>
    <h3>Account details</h3>
    <div>
        <?php $form = \App\core\form\Form::begin("", "post") ?>
            <?= $form->input($model, 'firstname')->setValue($firstname) ?>
            <?= $form->input($model, 'lastname')->setValue($lastname) ?>
            <?= $form->input($model, 'email')->setValue($email) ?>
            
            <button class="button" type="submit">Save change</button>
        <?= App\core\form\Form::end() ?>
    </div>
</section> 