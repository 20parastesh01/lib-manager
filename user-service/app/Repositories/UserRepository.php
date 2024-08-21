<?php

namespace App\Repositories;

use App\DTOs\SignupDTO;
use App\Models\User;

class UserRepository
{
    public function createUser(SignupDTO $data)
    {
        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password
        ]);
        return $user;
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}