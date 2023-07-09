<?php

namespace App\controllers;

use App\core\Application;
use App\core\exception\NotFoundException;
use App\core\Request;
use App\models\ContactForm;

/**
 * class Front
 * 
 * @package App\controllers
 */
class FrontController extends Controller
{
    
    public function __construct()
    {
        $this->layoutParams[]= [
            'value' => 'About',
            'url' => '/about'
        ];
        $this->layoutParams[]= [
            'value' => 'Contact',
            'url' => '/contact'
        ];
    }

    public function home(Request $request)
    {
        $slug = trim($request->getpath(), '/');
        $databaseSlug = 'about';
        if($slug){
            if($slug === 'about'){
                $params = [
                    'title' => "About us",
                    'content' => "Our story start in march 1999..",
                    'seo_title' => 'About',
                    'seo_desc' => 'This page tells more about us',
                    'seo_keywords' => 'Travel, Holiday, Destination'
                ];
                return $this->render('home', $params);
            }else{
                throw new NotFoundException();
            }
        }
        $params = [
            'title' => "Homepage",
            'content' => "Nous sommes ravie de votre visite.",
            'seo_title' => 'Home',
            'seo_desc' => 'Welcome to our travel agency',
            'seo_keywords' => 'Travel, Holiday, Destination'
        ];
        return $this->render('home', $params);
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
