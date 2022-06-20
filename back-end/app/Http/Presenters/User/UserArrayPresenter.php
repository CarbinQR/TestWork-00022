<?php

declare(strict_types=1);

namespace App\Http\Presenters\User;

use App\Models\User;
use Illuminate\Support\Collection;

final class UserArrayPresenter
{
    public function present(User $user): array
    {
        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'login' => $user->getLogin(),
            'createdAt' => $user->getCreatedAt(),
        ];
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                fn (User $user) => $this->present($user)
            )
            ->all();
    }
}
