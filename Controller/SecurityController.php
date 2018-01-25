<?php

namespace Controller;

use Library\Controller;
use Library\Request;
use Library\Session;
use Library\Password;
use Model\LoginForm;
use Model\RegistrationForm;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $form = new LoginForm($request);
        if($request->isPost()){
            if($form->isValid()){
                $password = new Password($form->password);
                $email = $form->email;

                $repo = $this->container->get('repository_manager')->getRepository('UserModel');
                if($user = $repo->find($email, $password)){
                    // var_dump($user);
                    Session::set('user', $user->getEmail());
                    Session::setFlash('Вы успешно залогинились!');

                    $this->container->get('router')->redirect('/admin');
                }
                Session::setFlash('Пользователь не найден!');
                $this->container->get('router')->redirect('/login');

            }
            Session::setFlash('Форма заполненна не коректно!');
        }

        return $this->render('login.phtml', ['form' => $form]);
    }

    public function logoutAction(Request $request)
    {
        Session::remove('user');
        $this->container->get('router')->redirect('/');
    }

    public function registerAction(Request $request)
    {
        $form = new RegistrationForm($request);

        if ($request->isPost()) {
            if ($form->isValid()) {

                // TODO: проверять, существует ли в базе уже юзер с таким имейлом
                // $model = new UserModel();
                // $model->check()
                $repo = $this->container->get('repository_manager')->getRepository('User');
                $repo->save(array(
                    'email' => $form->email,
                    'password' => new Password($form->password)
                ));

                Session::setFlash('Registered');
                $this->container->get('router')->redirect('/register');
            }

            Session::setFlash($form->getNotice());
        }

        $args = compact('form');

        return $this->render('register.phtml', $args);
    }
}