<?php

    $this->title = $page->getTitle();
    $this->description = $page->getSeoDescription();
    $this->keywords = $page->getSeoKeywords();

?>

<section>
    <h1><?= $template->getBlogTitle() ?></h1>
    <div>
        <h2><?= $template->getFirstSubTitle() ?></h2>
        <p><?= $template->getFirstParagraph() ?></p>
    </div>
    <div>
        <h2><?= $template->getSecondSubTitle() ?></h2>
        <p><?= $template->getSecondParagraph() ?></p>
    </div>

    <div>
        <h2><?= $template->getThirdSubTitle() ?></h2>
        <p><?= $template->getThirdParagraph() ?></p>
    </div>
    
    <?php if($template->getCommentSection() === 'show'):?>
        <h2>Give us your feedback !</h2>
        <?php $form = \App\core\form\Form::begin("", "post") ?>
            <?= $form->input($model, 'comment_name') ?>
            <?= $form->input($model, 'comment_email')?>
            <?= $form->textarea($model, 'comment_text') ?>
            <button style="padding:5px; margin-top:10px" type="submit">Submit</button>
        <?= App\core\form\Form::end() ?>

        <div>
            <h3>Comments</h3>
            <?php if(count($approuvedComments) !== 0): ?>
            <div>
                <?php foreach($approuvedComments as $comment): ?>
                    <h3><?=$comment->getCommentName() ?></h3>
                    <p><?=$comment->getCommentText() ?></p>
                <?php endforeach ?>
            </div>
            <?php else :?>
            <div>
                <p>Be the first to post a comment</p>
            </div>
            <?php endif ?>
        </div>
        <?php endif ?>
</section>