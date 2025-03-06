<?php

namespace Modules\NewsFeed\Enums;

enum PostStatus: int
{
    case DRAFT = 1;
    case PUBLISHED = 2;

    public function getLabel(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::PUBLISHED => 'Published',
        };
    }
}
