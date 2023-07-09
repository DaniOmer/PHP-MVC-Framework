/*
 * Copyright (c) 2023 by Hind SEDRATI
 * 
 *
 * File name: www/src/views/home.php
 * Creation date: 2023-07-09 04:09:27
 * Autor: Hind SEDRATI
 *
 * Last Modified: 4959ca7 2023-07-03 13:58:21
 */

if(isset($page)){
    $this->title = $page->getTitle() ?? '';
    $this->description = $page->getSeoDescription() ?? '';
    $this->keywords = $page->getSeoKeywords() ?? '';
}

?>

 