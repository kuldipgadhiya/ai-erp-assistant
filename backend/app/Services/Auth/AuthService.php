<?php

namespace App\Services\Auth;

use App\Repositories\Auth\AuthRepository;
use Illuminate\Support\Facades\Hash;
use App\DTOs\Auth\UserDTO;
use App\DTOs\Auth\LoginDTO;
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

    public function login(LoginDTO $loginDTO): ?User
    {
        $user = $this->authRepository->findByEmail($loginDTO->email);

        if ($user && Hash::check($loginDTO->password, $user->password)) {
            return $user;
        }

        return null;
    }

    public function createAuthToken(User $user): string
    {
        return $this->authRepository->createAuthToken($user);
    }
}