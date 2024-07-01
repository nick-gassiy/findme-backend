<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    public function register(array $data): bool
    {
        try {
            User::query()->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])
            ]);
            return true;
        }catch (\Exception $exception){
            return false;
        }
    }

    public function authenticate(array $data)
    {
        $user = User::query()->where('email', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)){
            return null;
        }
        return $user->createToken('authenticationToken')->plainTextToken;
    }
}
