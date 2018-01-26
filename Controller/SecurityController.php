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
    public function registerAction(Request $request)
    {
        $form = new RegistrationForm($request);

        if ($request->isPost()) {
            if ($form->isValid()) {

                $repo = $this->container->get('repository_manager')->getRepository('User');
                if (!empty($repo->checkExistUser($form->email))) {
                    Session::setFlash('Email already exist! Try another email.');
                    $this->container->get('router')->redirect('/register');
                } else {
                    $repo->save(array(
                        'email' => $form->email,
                        'password' => new Password($form->password)
                    ));

                    Session::setFlash('Registered successfully!');
                    $this->container->get('router')->redirect('/register');
                }
            }
                Session::setFlash($form->getNotice());
            }


        $args = compact('form');

        return $this->render('register.phtml', $args);
    }

    public function loginAction(Request $request)
    {
        $form = new LoginForm($request);

        if ($request->isPost()) {
            if ($form->isValid()) {

                $repo = $this->container->get('repository_manager')->getRepository('User');
                $password = new Password($form->password);
                $email = $form->email;

                if ($user = $repo->find($email, $password)) {
                    Session::set('user', $user['email']);

                    Session::setFlash('Signed in');
                    $this->container->get('router')->redirect('/admin');
                }

                Session::setFlash('User not found');
                $this->container->get('router')->redirect('/login');
            }

            Session::setFlash('Fill the fields');
        }

        return $this->render('login.phtml', compact('form'));
    }

    public function logoutAction(Request $request)
    {
        Session::remove('user');
        $this->container->get('router')->redirect('/');
    }
}