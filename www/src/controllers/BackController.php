<?php

/*
 * Copyright (c) 2023 by Hind SEDRATI
 * 
 *
 * File name: www/src/controllers/BackController.php
 * Creation date: 2023-07-09 04:09:27
 * Autor: Hind SEDRATI
 *
 * Last Modified: 4959ca7 2023-07-03 13:58:21
 */

namespace App\controllers;
 
use App\core\Application;
use App\core\exception\NotFoundException;
use App\core\middlewares\AccountMiddleware;
use App\core\middlewares\AdminEditorMiddleware;
use App\core\middlewares\AdminMiddleware;
use App\core\middlewares\AuthMiddleware;
use App\core\Request;
use App\core\SendMail;
use App\models\Blog;
use App\models\Contact;
use App\models\Homepage;
use App\models\Page;
use App\models\ResetPasswordFromDashboard;
use App\models\User;
use App\models\UserUpdateForm;

/**
 * class Front
 * 
 * @package App\controllers
 */
class BackController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware([
            'dashboard', 'profile', 'users', 'page', 'comment', 
            'chart', 'users', 'create', 'manage', 'reset', 'createPage', 
            'managePage', 'homepageTemplate', 'contactTemplate', 'blogTemplate'
        ]));
        $this->registerMiddleware(new AdminMiddleware(['users', 'create', 'manage']));
        //$this->registerMiddleware(new AdminEditorMiddleware(['managePage']));
    }


    public function profile(Request $request)
    {
        $userUpdateForm = new UserUpdateForm();

        if($request->isPost()){
            $userUpdateForm->loadData($request->getBody());
            $userID = Application::$app->user->getId();
            
            if($userUpdateForm->validate() && $userUpdateForm->updateUserInformations($userID)){
                Application::$app->session->setFlash('success', 'Your informations are succeffully update !');
            }
        }
        $this->setLayout('back');
        return $this->render('profile', [
            'model' => $userUpdateForm
        ]);
    }

    
    public function chart()
    {
        $this->setLayout('back');
        return $this->render('chart');
    }

    public function create(Request $request)
    {
        $user = new User();
        if($request->isPost()){
            $user->loadData($request->getBody());

            $mail = [];
            $mail['url'] = getenv('BASE_URL').'/verify?verification=';
            $mail['email'] = $user->getEmail();
            $mail['token'] = $user->getVerifyToken();
            $mail['bodyText'] = 'Here is the verification link : '; 
            if($user->validate() && $user->saveData()){
                $sendMail = new SendMail($mail);
                $sendMail->send();

                Application::$app->session->setFlash(
                    'success', 'The new user '.$user->getLastname().' has been successfully created.'
                );
                Application::$app->response->redirect('/dashboard/users/manage');
            }
        }
        $this->setLayout('back');
        return $this->render('create-user', [
            'model' => $user
        ]);
    }

    
    public function manage(Request $request)
    {
        $query = $request->getQueryParams()['edit'] ?? '' ;

        if($query !== ''){
            $user = Application::$app->user->getOneBy('id', $query);
            $updateUserFromAdmin = new UserUpdateForm();

            if($user){
                if($request->isPost()){
                    $updateUserFromAdmin->loadData($request->getBody());
                    if($updateUserFromAdmin->validate() && $updateUserFromAdmin->updateUserInformations($user->getId())){
                        Application::$app->session->setFlash('success', 'User\'s '.$user->getLastname().' details have been updated successfully !');
                        Application::$app->response->redirect('/dashboard/users/manage');
                    }
                }

                $this->setLayout('back');
                return $this->render('edit-user', [
                    'model' => $updateUserFromAdmin,
                    'firstname' => $user->getFirstname(),
                    'lastname' => $user->getLastname(),
                    'email' => $user->getEmail(),
                    'role' => $user->getRole()
                ]);
            }
        }

        $deleteQuery = $request->getQueryParams()['delete'] ?? '';
        if($deleteQuery !== ''){
            $user = Application::$app->user->getOneBy('id', $deleteQuery);

            if($user){
                Application::$app->user->delete($deleteQuery);
                Application::$app->session->setFlash('success', 'User\'s '.$user->getLastname().' has been deleted successfully !');
                Application::$app->response->redirect('/dashboard/users/manage');
            }
        }

        $this->setLayout('back');
        return $this->render('manage');
    }

    
    public function reset(Request $request)
    {
        $updateUserPassword = new ResetPasswordFromDashboard();

        if($request->isPost()){
            $updateUserPassword->loadData($request->getBody());

            if($updateUserPassword->validate() && $updateUserPassword->updateUserPassword()){
                Application::$app->session->setFlash('success', 'Your password has been update successfully !');
            }
        }
        $this->setLayout('back');
        return $this->render('reset-password-dashboard', [
            'model' => $updateUserPassword
        ]);
    }


    public function createPage(Request $request)
    {
        $page = new Page();

        if($request->isPost()){
            $page->loadData($request->getBody());

            if($page->validate() && $page->saveData()){
                $newPage = $page::getOneBy('title', $page->getTitle());
                Application::$app->response->redirect('/dashboard/template/'.$page->getTemplate().'?temp='.$newPage->getId().'');
            }
        }
        $this->setLayout('back');
        return $this->render('create-page', [
            'model' => $page
        ]);
    }


    public function managePage(Request $request)
    {
        $query = $request->getQueryParams()['edit'] ?? '' ;

        if($query !== ''){
            $page = Page::getOneBy('id', $query);

            if($page){
                if($request->isPost()){
                    $page->loadData($request->getBody());
                    if($page->validate() && $page->saveData()){
                        Application::$app->response->redirect('/dashboard/template/'.$page->getTemplate().'?temp='.$page->getId().'');
                    }
                }

                $page->setUserId($page->getUserId());
                $this->setLayout('back');
                return $this->render('edit-page', [
                    'model' => $page,
                    'title' => $page->getTitle(),
                    'seo_title' => $page->getSeoTitle(),
                    'seo_keywords' => $page->getSeoKeywords(),
                    'page_uri' => $page->getPageUri(),
                    'seo_description' => $page->getSeoDescription(),
                    'template' => $page->getTemplate()
                ]);
            }
        }

        $deleteQuery = $request->getQueryParams()['delete'] ?? '';
        if($deleteQuery !== ''){
            $page = Page::getOneBy('id', $deleteQuery);

            if($page){
                $page->delete($deleteQuery);
                Application::$app->session->setFlash('success', 'Page '.$page->getTitle().' has been deleted successfully !');
                Application::$app->response->redirect('/dashboard/page/manage');
            }
        }

        if(Application::$app->user){
            if(Application::$app->isAdmin()){
                $pages = Page::getAllBy('user_id', Application::$app->user->getId());
            }else{
                $pages = Page::getAllBy('user_id', Application::$app->user->getAdminId());
            }
        }

        $this->setLayout('back');
        return $this->render('manage-page', [
            'pages' => $pages
        ]);
    }



    public function homepageTemplate(Request $request)
    {
        $homepage = new Homepage();
        $page_id = $request->getQueryParams()['temp'];

        if($request->isPost()){
            $homepage->setPageId($page_id);
            $homepage->loadData($request->getBody());
            if($homepage->validate() && $homepage->saveData()){
                Application::$app->response->redirect('/dashboard/page/manage');
                Application::$app->session->setFlash('success', 'Your page creation is completed !');
            }else{
                Application::$app->session->setFlash('alerte', 'Something went wrong. Please try again !');
            }
        }

        $oldHomepage = Homepage::getOneBy('page_id', $page_id);
        if($oldHomepage){
            $this->setLayout('back');
            return $this->render('homepage-form', [
                'model' => $homepage,
                'oldHomepage' => $oldHomepage
            ]);
        }

        $this->setLayout('back');
        return $this->render('homepage-form', [
            'model' => $homepage,
        ]);
    }


    public function blogTemplate(Request $request)
    {
        $blog = new Blog();
        $page_id = $request->getQueryParams()['temp'];

        if($request->isPost()){
            $blog->setPageId($page_id);
            $blog->loadData($request->getBody());
            if($blog->validate() && $blog->saveData()){
                Application::$app->response->redirect('/dashboard/page/manage');
                Application::$app->session->setFlash('success', 'Your page creation is completed !');
            }else{
                Application::$app->session->setFlash('alerte', 'Something went wrong. Please try again !');
            }
        }

        $oldBlog = Blog::getOneBy('page_id', $page_id);
        if($oldBlog){
            $this->setLayout('back');
            return $this->render('homepage-form', [
                'model' => $blog,
                'oldHomepage' => $oldBlog
            ]);
        }

        $this->setLayout('back');
        return $this->render('blog-form', [
            'model' => $blog,
        ]);
    }


    /*
    public function contactTemplate(Request $request)
    {
        $contact = new Contact();
        $page_id = $request->getQueryParams()['temp'];

        if($request->isPost()){
            $contact->setPageId($page_id);
            $contact->loadData($request->getBody());
            if($contact->validate() && $contact->saveData()){
                Application::$app->response->redirect('/dashboard/page/manage');
                Application::$app->session->setFlash('success', 'Your page creation is completed !');
            }else{
                Application::$app->session->setFlash('alerte', 'Something went wrong. Please try again !');
            }
        }

        $this->setLayout('back');
        return $this->render('blog-form', [
            'model' => $contact,
        ]);
    }
    */



    public function comment(Request $request)
    {
        $blog = new Blog();
        $page_id = $request->getQueryParams()['temp'];

        if($request->isPost()){
            $blog->setPageId($page_id);
            $blog->loadData($request->getBody());
            if($blog->validate() && $blog->saveData()){
                Application::$app->response->redirect('/dashboard/page/manage');
                Application::$app->session->setFlash('success', 'Your page creation is completed !');
            }else{
                Application::$app->session->setFlash('alerte', 'Something went wrong. Please try again !');
            }
        }

        $this->setLayout('back');
        return $this->render('blog-form', [
            'model' => $blog,
        ]);
    }
}
