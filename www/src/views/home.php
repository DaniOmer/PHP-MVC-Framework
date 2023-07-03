<?php

if(isset($page)){
    $this->title = $page->getTitle() ?? '';
    $this->description = $page->getSeoDescription() ?? '';
    $this->keywords = $page->getSeoKeywords() ?? '';
}

?>

<h1><?= $page->getTitle() ?? '' ?></h1>
<p><?= $page->getContent() ?? '' ?></p>