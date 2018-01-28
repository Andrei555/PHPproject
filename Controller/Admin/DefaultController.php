<?php

namespace Controller\Admin;

use Library\Controller;
use Library\Session;

class DefaultController extends Controller
{
    public function indexAction()
    {
        if (Session::get('user') < 2) {
            $this->container->get('router')->redirect('/login');
        }
        
        return $this->render('index.phtml');
    }
}