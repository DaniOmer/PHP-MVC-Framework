<div style="width:40%; margin:0 auto;">
    <h1>Create an account</h1>

    <?php $form = \App\core\form\Form::begin("", "post") ?>
        <?= $form->input($model, 'firstname') ?>
        <?= $form->input($model, 'lastname') ?>
        <?= $form->input($model, 'email') ?>
        <?= $form->input($model, 'password')->passwordField() ?>
        <?= $form->input($model, 'confirmPassword')->passwordField() ?>
        <button style="padding:5px; margin-top:10px" type="submit">Register</button>
    <?= App\core\form\Form::end() ?>
</div>

