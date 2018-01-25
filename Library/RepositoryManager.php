<?php

namespace Library;

class RepositoryManager
{
    private $pdo;
    private $repositories = array();

    public function setPDO(\PDO $pdo)
    {
        $this->pdo = $pdo;

        return $this;
    }

    public function getRepository($entity) // 'Book' => BookModel
    {
        if(empty($this->repositories[$entity])){
            $repository = "\\Model\\{$entity}Model";
            // todo: create specific exception if file not found
            $repository = new $repository();
            $repository->setPDO($this->pdo);
            $this->repositories[$entity] = $repository;
        }

        return $this->repositories[$entity];
    }
}