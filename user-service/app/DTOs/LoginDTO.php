<?php

namespace App\DTOs;

use Illuminate\Http\Request;

class LoginDTO
{
    public $email;
    public $password;

    public static function fromRequest(Request $request)
    {
        $user = new LoginDTO();
        $user->email = $request->input('email');
        $user->password = $request->input('password');

        return $user;
    }
}