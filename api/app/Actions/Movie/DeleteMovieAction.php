<?php

declare(strict_types=1);

namespace App\Actions\Movie;

use App\Exceptions\Movie\MovieNotFoundException;
use App\Repositories\Movie\MovieRepositoryInterface;

final class DeleteMovieAction
{
    private MovieRepositoryInterface $movieRepository;

    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function execute(DeleteMovieRequest $request): void
    {
        $movie = $this->movieRepository->getById($request->getId());

        if (!$movie) {
            throw new MovieNotFoundException();
        }

        $this->movieRepository->delete($movie);
    }
}
