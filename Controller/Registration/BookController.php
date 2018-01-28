<?php

namespace Controller\Registration;

use Library\Controller;
use Library\Request;

class BookController extends Controller
{
    public function indexAction(Request $request)
    {
        $repo = $this->container->get('repository_manager')->getRepository('Book');

        $books = $repo->findAll();

        $args = ['books' => $books];
        return $this->render('index.phtml', $args);
    }

    public function showAction(Request $request)
    {
        $repo = $this->container->get('repository_manager')->getRepository('Book');
        $id = $request->get('id');
        $book = $repo->find($id);

        return $this->render('show.phtml', compact('book'));
    }
}