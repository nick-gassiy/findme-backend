<?php

namespace App\Enums\Media;

enum MediaCollectionEnum: int
{
    case AVATAR = 1;

    public function getType(): string
    {
        return match ($this){
            self::AVATAR => 'avatar',
        };
    }
}
