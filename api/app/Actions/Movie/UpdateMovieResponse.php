<?php

declare(strict_types=1);

namespace App\Actions\Movie;

use App\Models\Movie;

final class UpdateMovieResponse
{
    private Movie $updatedMovie;

    public function __construct(Movie $newMovie)
    {
        $this->updatedMovie = $newMovie;
    }

    public function getResponse(): Movie
    {
        return $this->updatedMovie;
    }
}
