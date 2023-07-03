<?php

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
        
        $pages = Page::getAll();
        foreach ($pages as $page) {
            $this->layoutParams[] = [
                'value' => $page->getTitle(),
                'url' => $page->getPageUri()
            ];
        }
    }


    public function home(Request $request)
    {
        $pageModel = new Page();
        $page = $pageModel::getOneBy('page_uri', $request->getpath());

        if($page){
            return $this->render('home', [
                'page' => $page
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
