<?php

namespace Controller;

use Library\Controller;
use Model\Form\ContactForm;
use Library\Request;
use Library\Session;

class SiteController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('index.phtml');
    }

    public function contactAction(Request $request)
    {
//        $form = new ContactForm($request);
//        $repo = $this->container->get('repository_manager')->getRepository('Feedback');
//
//        if ($request->isPost()){
//            if ($form->isValid()) {
//                $feedback = (new Feedback())
//                    ->setName($form->username)
//                    ->setEmail($form->email)
//                    ->setMessage($form->message)
//                    ->setIpAddress($request->getIpAddress());
//
//                $repo->save($feedback);
//                Session::setFlash('Feedback saved');
//                $this->container->get('router')->redirect('/contact-us');
//            }
//            Session::setFlash('Fill the fields');
//        }

        return $this->render('contact.phtml');
    }
}