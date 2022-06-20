<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Movie;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

final class MoviePolicy
{
    use HandlesAuthorization;

    public function update(Movie $movie): bool
    {
        return Auth::id() === $movie->user_id;
    }
}
