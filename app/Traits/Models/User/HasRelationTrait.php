<?php

namespace App\Traits\Models\User;

use App\Models\Profile\Profile;
use App\Models\Profile\UserProfile;

trait HasRelationTrait
{
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
