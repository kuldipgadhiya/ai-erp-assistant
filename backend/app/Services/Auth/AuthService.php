<?php

namespace App\Services\Auth;

use App\Repositories\Auth\AuthRepository;
use Illuminate\Support\Facades\Hash;
use App\DTOs\Auth\UserDTO;
use App\Models\User;

class AuthService
{
    public function __construct(protected AuthRepository $authRepository)
    {

    }

    public function register(UserDTO $userDTO): User
    {
        return $this->authRepository->create(
            [
                "name" => $userDTO->name,
                "email" => $userDTO->email,
                "password" => Hash::make($userDTO->password),
            ]
        );
    }
}