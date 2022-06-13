<?php

declare(strict_types=1);

namespace App\Actions\Movie;

use App\Exceptions\Movie\MovieNotFoundException;
use App\Repositories\Movie\MovieRepository;

final class GetMovieByIdAction
{
    private MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function execute(GetMovieByIdRequest $request): GetMovieByIdResponse
    {
        $movie = $this->movieRepository->getById($request->getId());

        if (!$movie) {
            throw new MovieNotFoundException();
        }

        return new GetMovieByIdResponse($movie);
    }
}
