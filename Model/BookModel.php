<?php

namespace Model;

use Library\EntityRepository;

class BookModel extends EntityRepository
{

    public function findAll()
    {
        $sth = $this->pdo->query('SELECT * FROM book');
        $sth->execute();
        $books = $sth->fetchall(\PDO::FETCH_ASSOC);

        return $books;
    }

    public function find($id)
    {
        $sql = 'select * from book where id = :id';
        $sth = $this->pdo->prepare($sql);
        $sth->execute(compact('id'));
        $data = $sth->fetch(\PDO::FETCH_ASSOC);
        return $data;
    }
}