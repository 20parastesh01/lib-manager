<?php

namespace App\Http\Controllers;

use App\DTOs\LoginDTO;
use App\DTOs\SignupDTO;
use App\DTOs\UpdateProfileDTO;
use App\Exceptions\LoginException;
use App\Exceptions\ProfileException;
use App\Exceptions\SignupException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\SignupResource;
use App\Services\UserService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

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

    public function getProfile()
    {
        try {
            $userId = Auth::id();
            return $this->successResponse(
                null,
                new ProfileResource($this->userService->getProfile($userId)),
                Response::HTTP_OK
            );

        } catch(\Exception $e) {
            return $this->failureResponse(
                $e->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        try {
            $userId = Auth::id();
            return $this->successResponse(
                'profile updated.',
                new ProfileResource($this->userService->updateProfile($userId, UpdateProfileDTO::fromRequest($request))),
                Response::HTTP_NO_CONTENT
            );

        } catch(ProfileException $e) {
            return $this->failureResponse(
                $e->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
