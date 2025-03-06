<?php

namespace Modules\NewsFeed\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\NewsFeed\Models\Post;

class PostRepository
{
    public function __construct(private Post $post) {}

    public function getPosts(): Collection
    {
        return $this->post->all();
    }

    public function findPostById(int $id): Post
    {
        return $this->post->findOrFail($id);
    }

    public function createPost(array $data): Post
    {
        return $this->post->create($data)->refresh();
    }

    public function updatePost(Post $post, array $data): false|Post
    {
        $updated = $post->update($data);

        if ($updated) {
            return $post->refresh();
        }

        return false;
    }

    public function deletePost(Post $post, bool $force = false): bool
    {
        if ($force) {
            return $post->forceDelete();
        }

        return $post->delete();
    }
}
