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
    'admin_book_pdf_export' => new Route('/admin/books/export', 'Admin\\Book', 'exportPdf'),

    // api. TODO: add methods
    'api_save_feedback' => new Route('/api/feedback', 'API\\Site', 'save'),
    //'api_add_to_cart' => new Route('/api/cart/add/{id}', 'API\\Cart', 'add'),
    //'api_add_to_cart' => new Route('/api/cart/add/{id}', 'API\\Cart', 'add'),
    'api_books_list' => new Route('/api/books', 'API\\Book', 'index'),
    'api_books_item' => new Route('/api/books/{id}', 'API\\Book', 'item', array('id' => '[0-9]+')),
    'api_books_create' => new Route('/api/books', 'API\\Book', 'create'),
    'api_books_update' => new Route('/api/books/{id}', 'API\\Book', 'update', array('id' => '[0-9]+')),
    'api_books_delete' => new Route('/api/books/{id}', 'API\\Book', 'delete', array('id' => '[0-9]+'))
);