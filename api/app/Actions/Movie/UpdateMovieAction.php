<?php

declare(strict_types=1);

namespace App\Actions\Movie;

use App\Exceptions\Movie\MovieNotFoundException;
use App\Repositories\Movie\MovieRepositoryInterface;

final class UpdateMovieAction
{
    private MovieRepositoryInterface $movieRepository;

    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function execute(UpdateMovieRequest $request): UpdateMovieResponse
    {
        $movie = $this->movieRepository->getById($request->getMovieId());

        if (!$movie) {
            throw new MovieNotFoundException();
        }

        $movie->name = $request->getName();
        $movie->description = $request->getDescription();
        $movie->release_date = $request->getReleaseDate();
        $movie->is_liked = $request->getIsLiked();

        return new UpdateMovieResponse(
            $this->movieRepository->update($movie)
        );
    }
}
