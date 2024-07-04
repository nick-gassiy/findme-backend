<?php

namespace App\Http\Controllers\Api\Profile;

use App\Enums\Media\MediaCollectionEnum;
use App\Enums\Models\User\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\CreateUserProfileRequest;
use App\Http\Responses\ApiResponse;
use App\Services\MediaService;
use App\Services\Profile\ProfileService;
use App\Services\Profile\UserProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    private ProfileService $profileService;
    private Request $creationRequest;

    public function __construct(
        private readonly MediaService $mediaService
    ){
        switch (auth()->user()?->type){
            case UserTypeEnum::USER->value:
                $this->profileService = new UserProfileService();
                $this->creationRequest = new CreateUserProfileRequest();
                break;
            default:
                break;
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate($this->creationRequest->rules());
            $this->profileService->create($request->toArray());
            return ApiResponse::created();
        }catch (\Exception $exception){
            return ApiResponse::error();
        }
    }

    public function uploadAvatar(Request $request)
    {
        try {
            $this->mediaService->saveSingleTypeImage(
                auth()->user()->profile,
                $request->avatar,
                MediaCollectionEnum::AVATAR);
            return ApiResponse::created();
        }catch(\Exception $exception){
            return ApiResponse::error();
        }
    }

    public function deleteAvatar(Request $request)
    {
        try {
            return $this->mediaService->deleteLastMedia(
                auth()->user()->profile,
                MediaCollectionEnum::AVATAR)
                ? ApiResponse::ok()
                : ApiResponse::notFound();
        }catch (\Exception $exception) {
            return ApiResponse::error();
        }
    }
}
