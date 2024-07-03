<?php

namespace App\Models\Profile;

use App\Traits\Models\UserProfile\HasRelationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory, HasRelationTrait;

    protected $fillable = ['first_name', 'last_name', 'bio', 'date_of_birth'];
}
