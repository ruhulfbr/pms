<?php

namespace Modules\AuthKit\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Modules\AuthKit\Models\User;

class UserRepository
{
    public function __construct(private User $user) {}

    public function getUsers(): Collection
    {
        return $this->user->get();
    }

    public function findUserById(int $id): User
    {
        return $this->user->findOrFail($id);
    }

    public function createUser(array $data): User
    {
        return $this->user->create($data)->refresh();
    }

    public function updateUser(User $user, array $data): bool|User
    {
        $updated = $user->update($data);

        if ($updated) {
            return $user->refresh();
        }

        return false;
    }

    public function deleteUser(User $user, bool $force = false): bool
    {
        if ($force) {
            return $user->forceDelete();
        }

        return $user->delete();
    }
}
