<?php

namespace Modules\NewsFeed\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\NewsFeed\Database\Factories\HashtagFactory;

class Hashtag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['tag'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
