<section style="width:50%; margin:0 auto;">
    <h3>Here's the place to create a new user</h3>
    <div>
        <?php $form = \App\core\form\Form::begin("", "post") ?>
            <?= $form->input($model, 'firstname') ?>
            <?= $form->input($model, 'lastname') ?>
            <?= $form->input($model, 'email') ?>
            <?= $form->select($model, 'role', ['editor' =>'Editor', 'user' => 'User']) ?>
            <?= $form->input($model, 'password')->passwordField() ?>
            <?= $form->input($model, 'confirmPassword')->passwordField() ?>
            <button style="padding:5px; margin-top:10px" type="submit">Create</button>
        <?= App\core\form\Form::end() ?>
    </div>
</section>