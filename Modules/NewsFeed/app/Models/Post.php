<?php

namespace Modules\NewsFeed\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\NewsFeed\Database\Factories\PostFactory;
use Modules\Posts\Enums\PostStatus;

class Post extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'content', 'status'];

    public function hashtags(): BelongsToMany
    {
        return $this->belongsToMany(Hashtag::class, 'hashtag_post');
    }



    // protected function casts(): array
    // {
    //     return [
    //         'published_at' => 'datetime',
    //         'status' => PostStatus::class,
    //     ];
    // }
}
