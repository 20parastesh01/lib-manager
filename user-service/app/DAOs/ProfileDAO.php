<?php

namespace App\DAOs;

class ProfileDAO
{
    public $name;
    public $email;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
    }
}
