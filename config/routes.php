<?php

use Library\Route;

return array(
    'default' => new Route('/', 'Site', 'index'),
    'index.php' => new Route('/webroot/index.php', 'Site', 'index'),
    'books_list' => new Route('/books', 'Book', 'index'),
    'book_page' => new Route('/book-{id}\.html', 'Book', 'show', array('id' => '[0-9]+') ),
    'contact_us' => new Route('/contact-us', 'Site', 'contact'),
    'login' => new Route('/login', 'Security', 'login'),
    'logout' => new Route('/logout', 'Security', 'logout'),
    'register' => new Route('/register', 'Security', 'register'),
    'activate_user' => new Route('/activate/{hash}', 'Security', 'activate', array('hash' => '[a-z0-9]{32}')),



    'registration_default' => new Route('/registration', 'Registration\\Site', 'index'),
    'registration_books' => new Route('/registration/books', 'Registration\\Book', 'index'),
    'registration_book_page' => new Route('/registration/book-{id}\.html', 'Registration\\Book', 'show', array('id' => '[0-9]+') ),
    'favorites_list' => new Route('/registration/favorites', 'Registration\\Favorites', 'showList'),
    'favorites_book_add' => new Route('/registration/favorites/{id}', 'Registration\\Favorites', 'add', array('id' => '[0-9]+')),
    'favorites_book_remove' => new Route('/registration/favorites/remove/{id}', 'Registration\\Favorites', 'remove', array('id' => '[0-9]+')),
    'favorites_book_clear' => new Route('/registration/favorites/clear', 'Registration\\Favorites', 'clear'),


    // admin routes
    'admin_default' => new Route('/admin', 'Admin\\Default', 'index'),
    'admin_books' => new Route('/admin/books', 'Admin\\Book', 'index'),
    'admin_book_edit' => new Route('/admin/books/edit/{id}', 'Admin\\Book', 'edit', array('id' => '[0-9]+')),
    'admin_book_remove' => new Route('/admin/books/remove/{id}', 'Admin\\Book', 'remove', array('id' => '[0-9]+')),
    'admin_add' => new Route('/admin/add', 'Admin\\Book', 'add'),
    'admin_book_pdf_export' => new Route('/admin/books/export', 'Admin\\Book', 'exportPdf'),
);