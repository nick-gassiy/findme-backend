<?php

namespace App\Models\Profile;

use App\Traits\Models\Profile\HasRelationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory, HasRelationTrait;

    protected $fillable = ['user_id', 'profilable_id', 'profilable_type'];
}
