<?php

namespace Controller\Registration;

use Library\Controller;
use Library\Request;
use Model\Favorites;


class FavoritesController extends Controller
{
    public function showListAction(Request $request)
    {
        $favorites = new Favorites();
        $booksIds = $favorites->getProducts();
        $repo = $this->container->get('repository_manager')->getRepository('Book');
        $books = $repo->findByIdArray($booksIds);
        //var_dump($booksIds);

        return $this->render('show.phtml', compact('books'));
    }

    public function addAction(Request $request)
    {
        $id = $request->get('id');

        $favorites = new Favorites();
        $favorites->addProduct($id);

        $this->container->get('router')->redirect("/registration/book-{$id}.html");
    }
    
    public function removeAction(Request $request)
    {
        $id = $request->get('id');
        //var_dump($id);
        $favorites = new Favorites();
        //var_dump($favorites);
        $favorites->deleteProduct($id);

        $this->container->get('router')->redirect("/registration/favorites");
    }
    
    public function clearAction(Request $request)
    {
        $favorites = new Favorites();
        $favorites->clear();

        $this->container->get('router')->redirect("/registration/favorites");
    }
}