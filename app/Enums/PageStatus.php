<?php

namespace App\Enums;

enum PageStatus: int
{
    case PUBLISHED = 1;
    case PENDING_REVIEW = 2;
    case DRAFT = 3;

    public function isPublished(): bool
    {
        return $this === self::PUBLISHED;
    }

    public function isPendingReview(): bool
    {
        return $this === self::PENDING_REVIEW;
    }

    public function isDraft(): bool
    {
        return $this === self::DRAFT;
    }

    public function getLabelText(): string
    {

        return match ($this) {
            self::PUBLISHED => 'published',
            self::PENDING_REVIEW => 'archived',
            self::DRAFT => 'draft',
        };
    }


    public function getLabelColor(): string
    {

        return match ($this) {
            self::PUBLISHED => 'bg-green-600',
            self::PENDING_REVIEW => 'bg-amber-600',
            self::DRAFT => 'bg-sky-600',
        };
    }

    public function getLabelHTML(): string
    {

        return sprintf(
            '<span class="rounded-md px-2 py-1 text-white %s">%s</span>',
            $this->getLabelColor(),
            $this->getLabelHTML()
        );
    }
}
