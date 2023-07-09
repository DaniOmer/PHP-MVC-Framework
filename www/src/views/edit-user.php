<section style="width:50%; margin:0 auto;">
    <h3>Here's the place to edit a user</h3>
    <div>
        <?php $form = \App\core\form\Form::begin("", "post") ?>
            <?= $form->input($model, 'firstname')->setValue($firstname) ?>
            <?= $form->input($model, 'lastname')->setValue($lastname) ?>
            <?= $form->input($model, 'email')->setValue($email) ?>
            <?= $form->select($model, 'role', ['editor' =>'Editor', 'user' => 'User'])->setValue($role ?? 'user') ?>
            <button style="padding:5px; margin-top:10px" type="submit">Save change</button>
        <?= App\core\form\Form::end() ?>
    </div>
</section> 