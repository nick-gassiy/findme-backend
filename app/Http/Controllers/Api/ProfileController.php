<?php

namespace App\Http\Controllers\Api;

use App\Enums\Models\User\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\CreateUserProfileRequest;
use App\Http\Responses\ApiResponse;
use App\Services\Profile\ProfileService;
use App\Services\Profile\UserProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private ProfileService $profileService;
    private Request $creationRequest;

    public function __construct()
    {
        switch (auth()?->user()?->type){
            default:
                $this->profileService = new UserProfileService();
                $this->creationRequest = new CreateUserProfileRequest();
                break;
        }
    }

    public function store(Request $request)
    {
        $request->validate($this->creationRequest->rules());
        return $this->profileService->create($request->toArray())
            ? ApiResponse::created()
            : ApiResponse::error();
    }
}
