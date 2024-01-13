<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum UserStatus: string implements HasLabel, HasColor, HasIcon
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

    public function getColor(): string
    {
        return match ($this) {
            self::NOT_VACCINATED => 'danger',
            self::SCHEDULED => 'warning',
            self::VACCINATED => 'success',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::NOT_VACCINATED => 'heroicon-o-x-circle',
            self::SCHEDULED => 'heroicon-o-exclamation-circle',
            self::VACCINATED => 'heroicon-o-check-circle',
        };
    }
}
