<?php

namespace App\Http\Controllers\Api;

use App\DTOs\Auth\LoginDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthService;
use App\DTOs\Auth\UserDTO;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService)
    {

    }
    //
    public function register(RegisterRequest $request)
    {
        $dto = UserDTO::fromArray($request->validated());

        $user = $this->authService->register($dto);

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ]
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $dto = LoginDTO::fromArray($request->validated());

        $user = $this->authService->login($dto);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = $this->authService->createAuthToken($user);

        return response()->json([
            'success' => true,
            'message' => 'User logged in successfully',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token
            ]
        ]);
    }
}
