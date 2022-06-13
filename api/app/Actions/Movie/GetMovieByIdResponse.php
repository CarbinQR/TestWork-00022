<?php

declare(strict_types=1);

namespace App\Actions\Movie;

use App\Models\Movie;

final class GetMovieByIdResponse
{
    private Movie $movie;

    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    public function getResponse(): Movie
    {
        return $this->movie;
    }
}
