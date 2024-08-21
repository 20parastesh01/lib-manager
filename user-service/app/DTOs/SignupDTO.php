<?php

namespace App\DTOs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupDTO
{
    public $name;
    public $email;
    public $password;

    public static function fromRequest(Request $request)
    {
        $user = new SignupDTO();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        return $user;
    }
}