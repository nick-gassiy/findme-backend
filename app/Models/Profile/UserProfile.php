<?php

namespace App\Models\Profile;

use App\Models\BaseModel;
use App\Traits\Models\UserProfile\HasRelationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends BaseModel
{
    use HasFactory, HasRelationTrait;

    protected $fillable = ['first_name', 'last_name', 'bio', 'date_of_birth'];
}
