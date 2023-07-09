<section style="width:50%; margin:0 auto;">
    <h3>Let's design your home page</h3>
    <div>
        <?php $form = \App\core\form\Form::begin("", "post") ?>
            <?php if(isset($oldHomepage)): ?>
            <?= $form->input($model, 'banner_link')->setValue($oldHomepage->getBannerLink()) ?>
            <?= $form->input($model, 'banner_text')->setValue($oldHomepage->getBannerText()) ?>
            <?= $form->input($model, 'content')->setValue($oldHomepage->getContent()) ?>
            <?php endif ?>

            <?= $form->input($model, 'banner_link') ?>
            <?= $form->input($model, 'banner_text') ?>
            <?= $form->input($model, 'content') ?>
            <button style="padding:5px; margin-top:10px" type="submit">Save</button>
        <?= App\core\form\Form::end() ?>
    </div>
</section>
