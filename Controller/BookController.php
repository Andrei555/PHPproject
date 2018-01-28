<?php

namespace Controller;

use Library\Controller;
use Library\Request;
use Library\Pagination;

class BookController extends Controller
{
    const BOOKS_PER_PAGE = 9;

    public function indexAction(Request $request)
    {
        $repo = $this->container->get('repository_manager')->getRepository('Book');
        $page = (int)$request->get('page', 1);
        $count = $repo->count();
        $books = $repo->findActiveByPage($page, self::BOOKS_PER_PAGE);
        if(!$books && $count) {
            $this->container->get('router')->redirect('/books');
        }
        $pagination = new Pagination(['itemsCount' => $count, 'itemsPerPage' => self::BOOKS_PER_PAGE, 'currentPage' => $page]);

        $args = ['books' => $books, 'pagination' => $pagination];
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