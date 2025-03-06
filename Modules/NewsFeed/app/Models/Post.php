<?php

namespace Modules\NewsFeed\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\NewsFeed\Database\Factories\PostFactory;
use Modules\Posts\Enums\PostStatus;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id', 'image', 'status', 'published_at'];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'status' => PostStatus::class,
        ];
    }

    protected static function newFactory(): PostFactory
    {
        return PostFactory::new();
    }
}
