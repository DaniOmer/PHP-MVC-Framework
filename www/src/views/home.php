<?php

if(isset($page)){
    $this->title = $page->getTitle() ?? '';
    $this->description = $page->getSeoDescription() ?? '';
    $this->keywords = $page->getSeoKeywords() ?? '';
}

?>

 