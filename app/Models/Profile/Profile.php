<?php

namespace App\Models\Profile;

use App\Models\BaseModel;
use App\Traits\Models\Profile\HasMedaCollectionTrait;
use App\Traits\Models\Profile\HasRelationTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Profile extends BaseModel implements HasMedia
{
    use HasRelationTrait,
        HasMedaCollectionTrait,
        HasFactory,
        InteractsWithMedia;

    protected $fillable = ['user_id', 'profilable_id', 'profilable_type'];
}
