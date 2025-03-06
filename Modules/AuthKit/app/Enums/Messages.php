<?php

namespace Modules\AuthKit\Enums;

enum Messages: string
{
    case SOMETHING_WENT_WRONG = 'Something went wrong.';
    case FAILED_TO_FETCH_USERS = 'Failed to fetch users.';
    case USER_NOT_FOUND = 'User not found.';
    case FAILED_TO_CREATE_USER = 'failed to create user.';
    case FAILED_TO_UPDATE_USER = 'failed to update user.';
    case FAILED_TO_DELETE_USER = 'failed to delete user.';
}
