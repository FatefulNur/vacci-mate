<?php

namespace App\Enums;

enum UserStatus: string
{
    case NOT_VACCINATED = 'not_vaccinated';
    case SCHEDULED = 'scheduled';
    case VACCINATED = 'vaccinated';

    public function getLabel(): string
    {
        return match ($this) {
            self::NOT_VACCINATED => 'Not Vaccinated',
            self::SCHEDULED => 'Scheduled',
            self::VACCINATED => 'Vaccinated',
        };
    }
}
