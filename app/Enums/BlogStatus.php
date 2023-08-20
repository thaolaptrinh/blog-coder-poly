<?php

namespace App\Enums;

enum BlogStatus: int
{
    case ACTIVE = 1;
    case INACTIVE = 2;
    case DRAFT = 3;
    case MAINTENANCE = 4;



    public static function getValues(): array
    {
        return [
            self::ACTIVE->value,
            self::DRAFT->value,
            self::MAINTENANCE->value,
            self::INACTIVE->value,
        ];
    }



    public function isActive(): bool
    {
        return $this === self::ACTIVE;
    }

    public function isInactive(): bool
    {
        return $this === self::INACTIVE;
    }

    public function isMaintenance(): bool
    {
        return $this === self::MAINTENANCE;
    }
    public function isDraft(): bool
    {
        return $this === self::DRAFT;
    }

    public function getLabelText(): string
    {

        return match ($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
            self::MAINTENANCE => 'Maintenance',
            self::DRAFT => 'Draft',
        };
    }
}
