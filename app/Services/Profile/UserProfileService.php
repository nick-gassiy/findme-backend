<?php

namespace App\Services\Profile;

use App\Models\Profile\Profile;
use App\Models\Profile\UserProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserProfileService implements ProfileService
{

    public function create(array $data)
    {
        try {
            DB::beginTransaction();
                $user = User::query()->find(auth()->id());
                $profile = new Profile();
                $content = UserProfile::query()->create([
                        'first_name' => $data['first_name'],
                        'last_name' => $data['last_name'],
                        'bio' => $data['bio'],
                        'date_of_birth' => Carbon::parse($data['date_of_birth'])
                    ]);

                $profile->profileable()->associate($content);
                $user->profile()->save($profile);

                DB::commit();
            return true;
        }catch (\Exception $exception){
            DB::rollBack();
            return false;
        }
    }

    public function update(int $id, array $data)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }

    public function findById(int $id)
    {
        // TODO: Implement findById() method.
    }
}
