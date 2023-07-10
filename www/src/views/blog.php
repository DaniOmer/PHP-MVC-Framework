<?php

    $this->title = $page->getTitle();
    $this->description = $page->getSeoDescription();
    $this->keywords = $page->getSeoKeywords();

?>

<body>
    <h1><?= $template->getTitle() ?></h1>
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
            <?= $form->input($model, 'comment_text') ?>
            <button style="padding:5px; margin-top:10px" type="submit">Submit</button>
        <?= App\core\form\Form::end() ?>

        <div>
            <h3>Comments</h3>
            
        </div>
        <?php endif ?>
</body>
</html>
