<?php
namespace Model\Form;
use Library\Request;
class BookForm
{
    public $title;
    public $author;
    public $genre;
    public $description;
    public $price;

    public function __construct(Request $request)
    {
        $this->title = $request->post('title');
        $this->author = $request->post('author');
        $this->genre = $request->post('genre');
        $this->description = $request->post('description');
        $this->price = $request->post('price');
    }
    public function isValid()
    {
        return $this->description !== '' &&
            $this->price !== '' &&
            $this->title !== '' &&
            $this->author !== '' &&
            $this->genre !== '';
    }

    public function setFromArray(array $book)
    {
        $this->title = $book['title'];
        $this->author = $book['author'];
        $this->genre = $book['genre'];
        $this->description = $book['description'];
        $this->price = $book['price'];
    }
}