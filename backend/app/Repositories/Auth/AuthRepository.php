<?php

namespace App\Repositories\Auth;

use App\Models\User;

class AuthRepository
{
    // Implement authentication related methods here
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function createAuthToken(User $user): string
    {
        return $user->createToken('auth_token')->plainTextToken;
    }


}