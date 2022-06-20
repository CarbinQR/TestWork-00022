<?php

declare(strict_types=1);

namespace App\Actions\Movie;

use App\Models\Movie;

final class AddMovieResponse
{
    private Movie $newMovie;

    public function __construct(Movie $newMovie)
    {
        $this->newMovie = $newMovie;
    }

    public function getResponse(): Movie
    {
        return $this->newMovie;
    }
}
