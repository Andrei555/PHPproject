<?php

namespace Model;

use Library\EntityRepository;

class BookModel extends EntityRepository
{
    public function findActiveByPage($page, $perPage)
    {
        $offset = ($page - 1) * $perPage;
        $sql = "SELECT * FROM book ORDER BY id LIMIT {$offset}, {$perPage}";
        $sth = $this->pdo->query($sql);
        $sth->execute();
        $books = $sth->fetchall(\PDO::FETCH_ASSOC);

        return $books;
    }


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

    public function saveBook(array $book)
    {
        $sth = $this->pdo->prepare('INSERT INTO book VALUES
                              (:id, :title, :author, :genre, :description)');
        $sth->execute($book);
    }

    public function saveEditedBook(array $book)
    {
        $sth = $this->pdo->prepare('UPDATE book SET title = :title, description = :description, author = :author, genre = :genre where id = :id');
        $sth->execute($book);
    }

    public function removeById($id)
    {
        $sth = $this->pdo->prepare('DELETE FROM book WHERE id = :book_id');
        $params = array(
            'book_id' => $id
        );
        $sth->execute($params);
    }

    public function findById($id)
    {
        $sth = $this->pdo->prepare('SELECT * FROM book WHERE id = :book_id');
        $params = array(
            'book_id' => $id
        );
        $sth->execute($params);

        $book = $sth->fetch(\PDO::FETCH_ASSOC);

        return $book;
    }

    public function findByIdArray(array $ids)
    {
        if (!$ids) {
            return array();
        }

        $params = array();

        foreach ($ids as $v) {
            $params[] = '?';
        }

        $params = implode(',', $params);


        $sth = $this->pdo->prepare("SELECT * FROM book WHERE id IN ({$params}) ORDER BY title");
        $sth->execute($ids);

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function count()
    {
        $sql = 'SELECT count(*) FROM book';
        $sth = $this->pdo->query($sql);
        return (int)$sth->fetchColumn();
    }
}