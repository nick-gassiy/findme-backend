<?php

namespace App\Traits\Models\Profile;

trait HasRelationTrait
{
    public function profileable()
    {
        return $this->morphTo();
    }
}
