<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthorizationRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Responses\ApiResponse;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function __construct(private readonly AuthService $authService)
    {
    }

    public function register(RegistrationRequest $request)
    {
        try {
            $this->authService->register($request->toArray());
            $token = $this->authService->authenticate($request->toArray());
            return ApiResponse::ok([
                'token' => $token
            ]);
        }catch (\Exception $exception){
            return ApiResponse::error();
        }

    }

    public function login(AuthorizationRequest $request)
    {
        try {
            $token = $this->authService->authenticate($request->toArray());
            return ApiResponse::ok([
                'token' => $token
            ]);
        }catch (\Exception $exception){
            return ApiResponse::error();
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return ApiResponse::ok();
    }
}
