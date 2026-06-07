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
}