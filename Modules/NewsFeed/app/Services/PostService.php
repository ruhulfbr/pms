<?php

namespace Modules\NewsFeed\Services;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Modules\NewsFeed\Enums\Messages;
use Modules\NewsFeed\Models\Hashtag;
use Modules\NewsFeed\Models\Post;
use Modules\NewsFeed\Repositories\PostRepository;

class PostService
{
    public function __construct(
        private PostRepository $postRepository,
    ) {}

    public function getPosts(): ?Collection
    {
        try {
            return $this->postRepository->getPosts();
        } catch (Exception $exception) {
            Log::error(Messages::FAILED_TO_FETCH_POSTS->value, ['exception' => $exception->getMessage()]);
        }

        return null;
    }

    public function getPostById(int $id): ?Post
    {
        try {
            return $this->postRepository->findPostById($id);
        } catch (Exception $exception) {
            Log::error(Messages::POST_NOT_FOUND->value, ['exception' => $exception->getMessage()]);
        }

        return null;
    }

    public function createPost(array $data): ?Post
    {
        try {
            $post = $this->postRepository->createPost($data);
            // Extract hashtags
            preg_match_all('/#(\w+)/', $data['content'], $matches);
            $hashtags = array_unique($matches[1]);

            foreach ($hashtags as $tag) {
                $hashtag = Hashtag::firstOrCreate(['tag' => $tag]);
                $post->hashtags()->attach($hashtag->id);
            }

            return $post;
        } catch (Exception $exception) {
            Log::error(Messages::FAILED_TO_CREATE_POST->value, ['exception' => $exception->getMessage()]);
        }

        return null;
    }

    public function updatePost(Post $post, array $data): ?Post
    {
        try {
            return $this->postRepository->updatePost($post, $data);
        } catch (Exception $exception) {
            Log::error(Messages::FAILED_TO_UPDATE_POST->value, ['exception' => $exception->getMessage()]);
        }

        return null;
    }

    public function deletePost(Post $post): bool
    {
        try {
            return $this->postRepository->deletePost($post);
        } catch (Exception $exception) {
            Log::error(Messages::FAILED_TO_DELETE_POST->value, ['exception' => $exception->getMessage()]);
        }

        return false;
    }
}
