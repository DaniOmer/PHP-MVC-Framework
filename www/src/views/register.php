<div style="width:40%; margin:0 auto;">
    <h1>Create an account</h1>

    <?php $form = \App\core\form\Form::begin("", "post") ?>
        <?= $form->field($model, 'firstname') ?>
        <?= $form->field($model, 'lastname') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password')->passwordField() ?>
        <?= $form->field($model, 'confirmPassword')->passwordField() ?>
        <button style="padding:5px; margin-top:10px" type="submit">Register</button>
    <?= App\core\form\Form::end() ?>
</div>

