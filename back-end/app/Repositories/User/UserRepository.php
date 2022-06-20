<?php

declare(strict_types=1);

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Collection;

final class UserRepository implements UserRepositoryInterface
{
    public function save(User $user): User
    {
        $user->save();

        return $user;
    }

    public function update(User $user): User
    {
        $user->update();

        return $user;
    }

    public function getAll(): Collection
    {
        return User::all();
    }

    public function getById(int $id): ?User
    {
        return User::firstWhere('id', $id);
    }

    public function getByEmail(string $email): ?User
    {
        return User::firstWhere('email', $email);
    }
}
