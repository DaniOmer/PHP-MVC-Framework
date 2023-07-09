<?php
/*
 * Copyright (c) 2023 by Hind SEDRATI
 * 
 *
 * File name: www/src/views/homepage.php
 * Creation date: 2023-07-09 04:09:27
 * Autor: Hind SEDRATI
 *
 * Last Modified: 4959ca7 2023-07-03 13:58:21
 */

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
