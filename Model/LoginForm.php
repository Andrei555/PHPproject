<?php

namespace Model;

use Library\Request;

class LoginForm
{
    public $email;
    public $password;

    public function __construct(Request $request)
    {
        $this->email = $request->post('email');
        $this->password = $request->post('password');

    }

    public function isValid()
    {
        $res = $this->email !== '' && $this->password !== '';
        return $res;
    }
}