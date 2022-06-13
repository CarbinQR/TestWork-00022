<?php

declare(strict_types=1);

namespace App\Actions\Movie;

use Illuminate\Pagination\LengthAwarePaginator;

final class GetMoviesByUserResponse
{
    private LengthAwarePaginator $movies;

    public function __construct(LengthAwarePaginator $movies)
    {
        $this->movies = $movies;
    }

    public function getResponse(): LengthAwarePaginator
    {
        return $this->movies;
    }
}
