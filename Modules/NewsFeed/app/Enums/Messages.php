<?php

namespace Modules\NewsFeed\Enums;

enum Messages: string
{
    case SOMETHING_WENT_WRONG = 'Something went wrong.';
    case FAILED_TO_FETCH_POSTS = 'Failed to fetch posts.';
    case POST_NOT_FOUND = 'Post not found.';
    case FAILED_TO_CREATE_POST = 'failed to create post.';
    case FAILED_TO_UPDATE_POST = 'failed to update post.';
    case FAILED_TO_DELETE_POST = 'failed to delete post.';
}
