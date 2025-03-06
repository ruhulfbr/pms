<?php

namespace Modules\AuthKit\Services;

use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Modules\AuthKit\Enums\Messages;
use Modules\AuthKit\Models\User;
use Modules\AuthKit\Repositories\UserRepository;

class UserService
{
    public function __construct(
        private UserRepository $userRepository,
    ) {}

    public function getUsers(): ?Collection
    {
        try {
            return $this->userRepository->getUsers();
        } catch (Exception $exception) {
            Log::error(Messages::FAILED_TO_FETCH_USERS->value, ['exception' => $exception->getMessage()]);
        }

        return null;
    }

    public function getUserById(int $id): ?User
    {
        try {
            return $this->userRepository->findUserById($id);
        } catch (Exception $exception) {
            Log::error(Messages::USER_NOT_FOUND->value, ['exception' => $exception->getMessage()]);
        }

        return null;
    }

    public function createUser(array $data): ?User
    {
        try {
            return $this->userRepository->createUser($data);
        } catch (Exception $exception) {
            Log::error(Messages::FAILED_TO_CREATE_USER->value, ['exception' => $exception->getMessage()]);
        }

        return null;
    }

    public function updateUser(User $user, array $data): ?User
    {
        try {
            return $this->userRepository->updateUser($user, $data);
        } catch (Exception $exception) {
            Log::error(Messages::FAILED_TO_UPDATE_USER->value, ['exception' => $exception->getMessage()]);
        }

        return null;
    }

    public function deleteUser(User $user): bool
    {
        try {
            return $this->userRepository->deleteUser($user);
        } catch (Exception $exception) {
            Log::error(Messages::FAILED_TO_DELETE_USER->value, ['exception' => $exception->getMessage()]);
        }

        return false;
    }
}
