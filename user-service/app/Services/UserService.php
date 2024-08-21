<?php

namespace App\Services;

use App\DTOs\LoginDTO;
use App\DTOs\SignupDTO;
use App\Exceptions\LoginException;
use App\Exceptions\SignupException;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(private UserRepository $userRepository)
    {
    }
    public function signup(SignupDTO $data)
    {
        try {
            $user = $this->userRepository->createUser($data);

            $token = auth('api')->setTTL(30)->login($user);

            return [
                'token'  => $token,
            ];

        } catch(\Exception $e) {
            throw new SignupException("failed to create user.");
        }
    }

    public function login(LoginDTO $data)
    {
        try {
            $user = $this->userRepository->findByEmail($data->email);

            if (!Hash::check($data->password, $user->password)) {
                throw new LoginException("incorrect credentials");
            }

            $token = auth('api')->setTTL(30)->login($user);

            return [
                'token'  => $token,
            ];
        } catch(\Exception $e) {
            throw new LoginException("failed to login.");
        }
    }
}