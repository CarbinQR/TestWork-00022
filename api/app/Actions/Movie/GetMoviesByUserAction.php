<?php

declare(strict_types=1);

namespace App\Actions\Movie;

use App\Repositories\Movie\MovieRepositoryInterface;
use Illuminate\Support\Facades\Auth;

final class GetMoviesByUserAction
{
    private MovieRepositoryInterface $movieRepositoryInterface;

    public function __construct(
        MovieRepositoryInterface $movieRepositoryInterface
    )
    {
        $this->movieRepositoryInterface = $movieRepositoryInterface;
    }

    public function execute(GetMoviesByUserRequest $request): GetMoviesByUserResponse
    {
        $movies = $this->movieRepositoryInterface->findCollectionByUser(
            Auth::id(),
            $request->getOrderDirection()
        );

        return new GetMoviesByUserResponse($movies);
    }
}
