<?php

namespace App\Repositories;

use App\DTOs\SignupDTO;
use App\DTOs\UpdateProfileDTO;
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

    public function findById($userId)
    {
        return User::where('id', $userId)->first();
    }

    public function update($userId, UpdateProfileDTO $data)
    {
        $user = $this->findById($userId);
        $updateData = [];

        if (isset($data->name)) {
            $updateData['name'] = $data->name;
        }
        if (isset($data->email)) {
            $updateData['email'] = $data->email;
        }
        $user->update($updateData);
        return $user;
    }
}