<?php

namespace App\Http\Controllers;

use App\DTOs\LoginDTO;
use App\DTOs\SignupDTO;
use App\Exceptions\LoginException;
use App\Exceptions\SignupException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\SignupResource;
use App\Services\UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    )
    { }

    public function signup(SignupRequest $request)
    {
        try {
            return $this->successResponse(
                'user created.',
                new SignupResource($this->userService->signup(SignupDTO::fromRequest($request))),
                Response::HTTP_CREATED
            );

        } catch(SignupException $e) {
            return $this->failureResponse(
                $e->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            return $this->successResponse(
                'user logged in.',
                new LoginResource($this->userService->login(LoginDTO::fromRequest($request))),
                Response::HTTP_OK
            );

        } catch(LoginException $e) {
            return $this->failureResponse(
                $e->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
