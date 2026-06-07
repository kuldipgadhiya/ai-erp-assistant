<?php

namespace App\Services\Auth;

use App\Repositories\Auth\AuthRepository;
use Illuminate\Support\Facades\Hash;
class AuthService
{
    public function __construct(protected AuthRepository $authRepository)
    {

    }

    public function register(array $data)
    {
        // Hash the password before saving
        $data['password'] = Hash::make($data['password']);
        return $this->authRepository->create($data);
    }
}