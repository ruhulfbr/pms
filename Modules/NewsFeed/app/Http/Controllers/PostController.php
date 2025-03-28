<?php

namespace Modules\NewsFeed\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Modules\NewsFeed\Enums\Messages;
use Modules\NewsFeed\Http\Requests\CreatePostRequest;
use Modules\NewsFeed\Http\Requests\UpdatePostRequest;
use Modules\NewsFeed\Models\Hashtag;
use Modules\NewsFeed\Models\Post;
use Modules\NewsFeed\Response\HandleResponse;
use Modules\NewsFeed\Services\PostService;
use Modules\NewsFeed\Transformers\PostResource;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function __construct(private PostService $postService) {}

    public function index(): JsonResponse
    {
        $posts = $this->postService->getPosts();

        return $posts
            ? HandleResponse::success(PostResource::collection($posts))
            : HandleResponse::error(Messages::FAILED_TO_FETCH_POSTS);
    }

    public function store(CreatePostRequest $request): JsonResponse
    {
        $post = $this->postService->createPost($request->validated());
        
        return $post
            ? HandleResponse::success(new PostResource($post), Response::HTTP_CREATED)
            : HandleResponse::error(Messages::FAILED_TO_CREATE_POST);
    }

    public function show(Post $post): JsonResponse
    {
        return HandleResponse::success(new PostResource($post));
    }

    public function update(UpdatePostRequest $request, Post $post): JsonResponse
    {
        $post = $this->postService->updatePost($post, $request->validated());

        return $post
            ? HandleResponse::success(new PostResource($post))
            : HandleResponse::error(Messages::FAILED_TO_UPDATE_POST);
    }

    public function destroy(Post $post): JsonResponse
    {
        return $this->postService->deletePost($post)
            ? HandleResponse::success([], Response::HTTP_NO_CONTENT)
            : HandleResponse::error(Messages::FAILED_TO_DELETE_POST);
    }

    // Has tag data get by different method
    public function getPostsByHashtag($tag): JsonResponse
    {
        $hashtag = Hashtag::where('tag', $tag)->first();

        if (!$hashtag) {
            return response()->json(['message' => 'No posts found for this hashtag'], 404);
        }

        $posts = $hashtag->posts()->with('hashtags')->latest()->paginate(10);

        return response()->json(PostResource::collection($posts));
    }
}
