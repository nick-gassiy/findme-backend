<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function register(array $data): void
    {
        User::query()->create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function authenticate(array $data): ?string
    {
        $user = User::query()->where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)){
            throw new \Exception();
        }
        return $user->createToken('authenticationToken')->plainTextToken;
    }
}
