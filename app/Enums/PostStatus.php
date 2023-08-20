<?php

namespace App\Enums;

enum PostStatus: int
{
    case DRAFT = 1;
    case PENDING_REVIEW = 2;
    case PUBLISHED = 3;

    public static function getValues(): array
    {
        return [
            self::DRAFT->value,
            self::PUBLISHED->value,
            self::PENDING_REVIEW->value,
        ];
    }



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
