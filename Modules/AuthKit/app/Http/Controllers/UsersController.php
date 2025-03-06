<?php

namespace Modules\AuthKit\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\AuthKit\Enums\Messages;
use Modules\AuthKit\Http\Requests\CreateUserRequest;
use Modules\AuthKit\Http\Requests\UpdateUserRequest;
use Modules\AuthKit\Models\User;
use Modules\AuthKit\Response\HandleResponse;
use Modules\AuthKit\Services\UserService;
use Modules\AuthKit\Transformers\UserResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function index(): JsonResponse
    {
        $users = $this->userService->getUsers();

        return $users
            ? HandleResponse::success(UserResource::collection($users))
            : HandleResponse::error(Messages::FAILED_TO_FETCH_USERS);
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        $user = $this->userService->createUser($request->validated());

        return $user
            ? HandleResponse::success(new UserResource($user), Response::HTTP_CREATED)
            : HandleResponse::error(Messages::FAILED_TO_CREATE_USER);
    }

    public function show(User $user): JsonResponse
    {
        return HandleResponse::success(new UserResource($user));
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $updatedUser = $this->userService->updateUser($user, $request->validated());

        return $updatedUser
            ? HandleResponse::success(new UserResource($updatedUser))
            : HandleResponse::error(Messages::FAILED_TO_UPDATE_USER);
    }

    public function destroy(User $user): JsonResponse
    {
        return $this->userService->deleteUser($user)
            ? HandleResponse::success([], Response::HTTP_NO_CONTENT)
            : HandleResponse::error(Messages::FAILED_TO_DELETE_USER);
    }
}
