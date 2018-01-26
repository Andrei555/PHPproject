<?php

namespace Controller\Admin;

use Library\Controller;
use Library\Request;
use Library\Session;
use Model\BookForm;

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
        if (!Session::has('user')) {
            $this->container->get('router')->redirect('/login');
        }

        $repo = $this->container->get('repository_manager')->getRepository('Book');
        $form = new BookForm($request);

        $id = $request->get('id');
        $book = $repo->findById($id);

        if ($request->isPost()) {
            if ($form->isValid()) {
                $repo->saveEditedBook(array(
                    'id' => $id,
                    'title' => $form->title,
                    'author' => $form->author,
                    'genre' => $form->genre,
                    'description' => $form->description,
                ));
                Session::setFlash('The changes were saved!');
                $this->container->get('router')->redirect('/admin/books/edit/' . $id);
            }
        }
        $args = compact('book', 'form');
        return $this->render('edit.phtml', $args);
    }

    public function addAction(Request $request)
    {
        $form = new BookForm($request);
        $repo = $this->container->get('repository_manager')->getRepository('Book');

        if ($request->isPost()){
            if ($form->isValid()) {
                $repo->saveBook(array(
                    'id' => null,
                    'title' => $form->title,
                    'author' => $form->author,
                    'genre' => $form->genre,
                    'description' => $form->description,
                ));

                Session::setFlash('The book was successfully saved!');
                $this->container->get('router')->redirect('/admin/add');
            }
            Session::setFlash('Fill the fields!');
        }

        return $this->render('add.phtml', ['form' => $form]);
    }

    public function removeAction(Request $request)
    {
        $repo = $this->container->get('repository_manager')->getRepository('Book');
        if (!Session::has('user')) {
            $this->container->get('router')->redirect('/login');
        }

        $id = $request->get('id');

        $repo->removeById($id);

        $this->container->get('router')->redirect('/admin/books');
    }
}