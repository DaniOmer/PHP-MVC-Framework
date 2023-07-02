<?php

namespace App\controllers;

use App\core\Application;
use App\core\exception\NotFoundException;
use App\core\middlewares\AccountMiddleware;
use App\core\middlewares\AdminMiddleware;
use App\core\middlewares\AuthMiddleware;
use App\core\Request;
use App\core\SendMail;
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
            'dashboard', 'profile', 'users', 'page', 'comment', 'chart', 'users', 'create', 'manage'
        ]));
        $this->registerMiddleware(new AdminMiddleware(['users', 'create', 'manage']));
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

    public function users(Request $request)
    {
        $this->setLayout('back');
        return $this->render('users');
    }

    public function page()
    {
        $this->setLayout('back');
        return $this->render('page');
    }

    public function comment()
    {
        $this->setLayout('back');
        return $this->render('comment');
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
            $mail['url'] = Application::$app->baseUrl.'/verify?verification=';
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
}
