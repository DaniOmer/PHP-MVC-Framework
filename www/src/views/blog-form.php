<section style="width:50%; margin:0 auto;">
    <h3>Let's design your home page</h3>
    <div>
        <?php $form = \App\core\form\Form::begin("", "post") ?>
        <?php if(isset($oldBlog)): ?>
            <?= $form->input($model, 'blog_title')->setValue($oldBlog->getBlogTitle()) ?>
            <?= $form->input($model, 'first_sub_title')->setValue($oldBlog->getFirstSubTitle()) ?>
            <?= $form->textarea($model, 'first_paragraph')->setValue($oldBlog->getFirstParagraph()) ?>
            <?= $form->input($model, 'second_sub_title')->setValue($oldBlog->getSecondSubTitle()) ?>
            <?= $form->textarea($model, 'second_paragraph')->setValue($oldBlog->getSecondParagraph()) ?>
            <?= $form->input($model, 'third_sub_title')->setValue($oldBlog->getThirdSubTitle()) ?>
            <?= $form->textarea($model, 'third_paragraph')->setValue($oldBlog->getThirdParagraph()) ?>
            <?= $form->select($model, 'comment_section', ['show' => 'Show', 'hide' => 'Hide'])->setValue($oldBlog->getCommentSection()) ?>
        <? else: ?>
            <?= $form->input($model, 'blog_title') ?>
            <?= $form->input($model, 'first_sub_title') ?>
            <?= $form->textarea($model, 'first_paragraph') ?>
            <?= $form->input($model, 'second_sub_title') ?>
            <?= $form->textarea($model, 'second_paragraph') ?>
            <?= $form->input($model, 'third_sub_title') ?>
            <?= $form->textarea($model, 'third_paragraph') ?>
            <?= $form->select($model, 'comment_section', ['show' => 'Show', 'hide' => 'Hide']) ?>
            <button style="padding:5px; margin-top:10px" type="submit">Save</button>
        <?php endif ?>
        <?= App\core\form\Form::end() ?>
    </div>
</section>

 