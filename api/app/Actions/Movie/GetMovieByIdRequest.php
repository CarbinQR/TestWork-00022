<?php

declare(strict_types=1);

namespace App\Actions\Movie;

final class GetMovieByIdRequest
{
    private int $movieId;

    public function __construct(int $movieId)
    {
        $this->movieId = $movieId;
    }

    public function getId(): int
    {
        return $this->movieId;
    }
}
