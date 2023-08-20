<?php

namespace App\Enums;

enum PostLayout: int
{
    case LEFT_SIDEBAR = 1;
    case FULL_WIDTH = 2;
    case RIGHT_SIDEBAR = 3;


    public static function getValues(): array
    {
        return [
            self::LEFT_SIDEBAR->value,
            self::FULL_WIDTH->value,
            self::RIGHT_SIDEBAR->value,
        ];
    }


    public function isNoSidebar(): bool
    {
        return $this === self::FULL_WIDTH;
    }

    public function isLeftSidebar(): bool
    {
        return $this === self::LEFT_SIDEBAR;
    }

    public function isRightSidebar(): bool
    {
        return $this === self::RIGHT_SIDEBAR;
    }

    public function getClass(): string
    {

        return match ($this) {
            self::LEFT_SIDEBAR => 'is-left',
            self::FULL_WIDTH => 'no-sidebar',
            self::RIGHT_SIDEBAR => '',
        };
    }
}
