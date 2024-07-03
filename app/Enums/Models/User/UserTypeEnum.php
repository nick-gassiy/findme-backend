<?php

namespace App\Enums\Models\User;

enum UserTypeEnum: int
{
    case USER = 1;
    case MODERATOR = 15;
    case COMPANY = 30;

    public function getType(): string
    {
        return match ($this){
            self::USER => 'USER',
            self::MODERATOR => 'MODERATOR',
            self::COMPANY => 'COMPANY',
        };
    }
}
