<?php

namespace App\Traits\Models\UserProfile;

use App\Models\Profile\Profile;
use App\Models\User;

trait HasRelationTrait
{
    public function profile()
    {
        return $this->morphOne(Profile::class, 'profileable');
    }
}
