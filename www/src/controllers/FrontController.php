<?php


namespace App\controllers;
 
use App\core\Application;
use App\core\Request;
use App\models\Comment;
use App\models\ContactForm;
use App\models\Page;

/**
 * class Front
 * 
 * @package App\controllers
 */
class FrontController extends Controller
{

    public function home(Request $request)
    {
        $pageModel = new Page();
        $uri = trim($request->getpath(), '/');
        $page = $pageModel::getOneBy('page_uri', $uri);

        
        if($page){
            $templateName = $page->getTemplate();
            $templateClass = 'App\models\\'.ucfirst($templateName);
            $oneTemplate = new $templateClass();
            $commentModel = new Comment();

            $template = $oneTemplate->getOneBy('page_id', $page->getId());

            if(!$template){
                Application::$app->response->redirect('/dashboard/template/'.$templateName.'?temp='.$page->getId().'');
                Application::$app->session->setFlash('alerte', 'Please complete your page template setup and try again !');
            }

            if($template->getCommentSection() && $template->getCommentSection() === 'show'){
                $approuvedComments = $commentModel::getAllBy('comment_status', 'approved');

                return $this->render($templateName, [
                    'page' => $page,
                    'template' => $template,
                    'model' => $commentModel,
                    //'approuvedComments' => $approuvedComments
                ]);
                
            }

            return $this->render($templateName, [
                'page' => $page,
                'template' => $template,
            ]);
        }
        return $this->render('home');
    }
    
}
