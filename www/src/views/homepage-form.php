<section style="width:50%; margin:0 auto;">
    <h3>Let's design your home page</h3>
    <div>
        <?php $form = \App\core\form\Form::begin("", "post") ?>
            <?= $form->input($model, 'banner_link') ?>
            <?= $form->input($model, 'banner_text') ?>
            <?= $form->input($model, 'content') ?>
            <button style="padding:5px; margin-top:10px" type="submit">Save</button>
        <?= App\core\form\Form::end() ?>
    </div>
</section>
 