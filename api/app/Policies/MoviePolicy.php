<?php

namespace App\Policies;

use App\Exceptions\User\PageNotFoundException;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

final class MoviePolicy
{
    use HandlesAuthorization;

    public function update(User $user, Movie $movie): bool
    {
        return $user->id === $movie->user_id ?: throw  new PageNotFoundException();
    }
}
