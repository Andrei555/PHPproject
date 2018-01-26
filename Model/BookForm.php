<?php

namespace Model;

use Library\Request;

class BookForm
{
    public $title;
    public $author;
    public $genre;
    public $description;

    public function __construct(Request $request)
    {
        $this->title = $request->post('title');
        $this->author = $request->post('author');
        $this->genre = $request->post('genre');
        $this->description = $request->post('description');
    }
    public function isValid()
    {
        return $this->description !== '' &&
            $this->title !== '' &&
            $this->author !== '' &&
            $this->genre !== '';
    }

//    public function setFromArray(array $book)
//    {
//        $this->title = $book['title'];
//        $this->author = $book['author'];
//        $this->genre = $book['genre'];
//        $this->description = $book['description'];
//        $this->price = $book['price'];
//    }
}