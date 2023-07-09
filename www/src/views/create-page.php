<section style="width:50%; margin:0 auto;">
    <h3>Here's the place to create a new page</h3>
    <div>
        <?php $form = \App\core\form\Form::begin("", "post") ?>
            <?= $form->input($model, 'title') ?>
            <?= $form->input($model, 'seo_title') ?>
            <?= $form->input($model, 'seo_keywords') ?>
            <?= $form->input($model, 'page_uri') ?>
            <?= $form->textarea($model, 'seo_description') ?>
            <?= $form->select($model, 'template', ['homepage' =>'Homepage', 'gallery' => 'Gallery', 'blog' => 'Blog']) ?>
            <?= $form->select($model, 'on_menu', ['show' =>'Show', 'hide' => 'Hide']) ?>
            <button style="padding:5px; margin-top:10px" type="submit">Create</button>
        <?= App\core\form\Form::end() ?>
    </div>
</section>