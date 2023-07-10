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
    
   
</body>
</html>
