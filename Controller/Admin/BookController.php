<?php

namespace Controller\Admin;

use Library\Controller;
use Library\Request;
use Library\Session;
use Model\Form\BookForm;

class BookController extends Controller
{
    public function indexAction(Request $request)
    {
        if(!Session::has('user')){
            $this->container->get('router')->redirect('/login');
        }

        $repo = $this->container->get('repository_manager')->getRepository('Book');
        // todo: findActive();
        $books = $repo->findAll();

        $args = ['books' => $books];
        return $this->render('index.phtml', $args);
    }

    public function editAction(Request $request)
    {
        if(!Session::has('user')){
            $this->container->get('router')->redirect('/login');
        }

        $id = $request->get('id');
        $book = $this
            ->container
            ->get('repository_manager')
            ->getRepository('Book')
            ->find($id);


        $form = new BookForm($request); // todo
        if($request->isPost()){
            if($form->isValid()){
                // save($book)
            }
        }
    }

    public function newAction(Request $request)
    {

    }

    public function deleteAction(Request $request)
    {
//        $id = $request->get('id');
//        $this
//            ->container
//            ->get('repository_manager')
//            ->getRepository('Book')
//            ->removeById($id);
    }
}