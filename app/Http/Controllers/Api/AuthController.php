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
        if ($this->authService->register($request->toArray())){
            $token = $this->authService->authenticate($request->toArray());
            return ApiResponse::ok([
                'token' => $token
            ]);
        }
        return new ApiResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function login(AuthorizationRequest $request)
    {
        $token = $this->authService->authenticate($request->toArray());
        return ApiResponse::ok([
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return new ApiResponse(Response::HTTP_OK);
    }
}
