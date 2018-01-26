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
    'cart_list' => new Route('/cart', 'Cart', 'showList'),
    'cart_add' => new Route('/cart/add/{id}', 'Cart', 'add', array('id' => '[0-9]+')),

    // admin routes
    'admin_default' => new Route('/admin', 'Admin\\Default', 'index'),
    'admin_books' => new Route('/admin/books', 'Admin\\Book', 'index'),
    'admin_book_edit' => new Route('/admin/books/edit/{id}', 'Admin\\Book', 'edit', array('id' => '[0-9]+')),
    'admin_book_remove' => new Route('/admin/books/remove/{id}', 'Admin\\Book', 'remove', array('id' => '[0-9]+')),
    'admin_add' => new Route('/admin/add', 'Admin\\Book', 'add'),
    'admin_book_pdf_export' => new Route('/admin/books/export', 'Admin\\Book', 'exportPdf'),
);