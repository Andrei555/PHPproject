<?php

namespace Model;

use Library\EntityRepository;

class UserModel extends EntityRepository
{
    public function find($email, $password)
    {
        $sth = $this->pdo->prepare('SELECT * FROM user WHERE email = :email AND password = :password LIMIT 1');
        $sth->execute(compact('email', 'password'));
        $user = $sth->fetch(\PDO::FETCH_ASSOC);
        return $user;
    }

    public function save(array $user)
    {
        $sth = $this->pdo->prepare('INSERT INTO user (email, password, status) VALUES (:email, :password, :status)');
        $sth->execute($user);
    }

    public function checkExistUser($email)
    {
        $sth = $this->pdo->query("SELECT email FROM user WHERE email = '{$email}' LIMIT 1");
        $res = $sth->fetchAll(\PDO::FETCH_ASSOC);

        return $res;
    }
}