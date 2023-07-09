<section style="width:50%; margin:0 auto;">
    <h3>Here's the place to update your page</h3>
    <div>
        <?php $form = \App\core\form\Form::begin("", "post") ?>
            <?= $form->input($model, 'title')->setValue($title) ?>
            <?= $form->input($model, 'seo_title')->setValue($seo_title) ?>
            <?= $form->input($model, 'seo_keywords')->setValue($seo_keywords) ?>
            <?= $form->input($model, 'page_uri')->setValue($page_uri) ?>
            <?= $form->textarea($model, 'seo_description')->setValue($seo_description) ?>
            <?= $form->select($model, 'template', ['homepage' =>'Homepage', 'gallery' => 'Gallery', 'blog' => 'Blog'])->setValue($template) ?>
            <?= $form->select($model, 'on_menu', ['show' =>'Show', 'hide' => 'Hide'])->setValue($template) ?>
            <button style="padding:5px; margin-top:10px" type="submit">Save change</button>
        <?= App\core\form\Form::end() ?>
    </div>
</section>