<?php

    $this->title = $page->getTitle();
    $this->description = $page->getSeoDescription();
    $this->keywords = $page->getSeoKeywords();

?>

<section class="container">
    <div class="d-flex flex-wrap justify-content-center align-items-center">
        <div class="banner banner--text">
            <img src="<? $template->getBannerLink() ?>" alt="Banner image">
            <p><?= $template->getBannerText() ?></p>
            <p><?= $template->getContent() ?></p>
        </div>
    </div>
</section>
