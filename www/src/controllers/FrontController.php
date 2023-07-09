<?php

/*
 * Copyright (c) 2023 by Hind SEDRATI
 * 
 *
 * File name: www/src/controllers/FrontController.php
 * Creation date: 2023-07-09 04:09:27
 * Autor: Hind SEDRATI
 *
 * Last Modified: 4959ca7 2023-07-03 13:58:21
 */

namespace App\controllers;
 
use App\core\Application;
use App\core\Request;
use App\models\ContactForm;
use App\models\Page;


/**
 * class Front
 * 
 * @package App\controllers
 */
class FrontController extends Controller
{

    public function __construct()
    {
        $pages = Page::getAllBy('on_menu', 'show');
        if($pages){
            foreach ($pages as $page) {
                $this->layoutParams[] = [
                    'value' => $page->getTitle(),
                    'url' => $page->getPageUri()
                ];
            }
        }
    }


    public function home(Request $request)
    {
        $pageModel = new Page();
        $uri = trim($request->getpath(), '/');
        $page = $pageModel::getOneBy('page_uri', $uri);

        if($page){
            $templateName = $page->getTemplate();
            $templateClass = 'App\models\\'.ucfirst($templateName);
            $oneTemplate = new $templateClass();

            $template = $oneTemplate->getOneBy('page_id', $page->getId());

            if(!$template){
                Application::$app->response->redirect('/dashboard/template/'.$templateName.'?temp='.$page->getId().'');
                Application::$app->session->setFlash('alerte', 'Please complete your page template setup and try again !');
            }
            return $this->render($templateName, [
                'page' => $page,
                'template' => $template
            ]);
        }
        return $this->render('home');
    }


    public function contact(Request $request)
    {
        $contact = new ContactForm();
        if($request->isPost()){
            $contact->loadData($request->getBody());
            if($contact->validate() && $contact->send()){
                Application::$app->session->setFlash('success', 'Thanks for contacting us !');
                Application::$app->response->redirect('/');
            }

        }
        return $this->render('contact', [
            'model' => $contact
        ]);
    }
    
}
