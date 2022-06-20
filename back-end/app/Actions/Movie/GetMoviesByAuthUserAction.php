<?php

declare(strict_types=1);

namespace App\Actions\Movie;

use App\Constant\MovieConstant;
use App\Repositories\Movie\MovieRepositoryInterface;
use Illuminate\Support\Facades\Auth;

final class GetMoviesByAuthUserAction
{
    private MovieRepositoryInterface $movieRepositoryInterface;

    public function __construct(
        MovieRepositoryInterface $movieRepositoryInterface
    ) {
        $this->movieRepositoryInterface = $movieRepositoryInterface;
    }

    public function execute(GetMoviesByAuthUserRequest $request): GetMoviesByAuthUserResponse
    {
        $movies = $this->movieRepositoryInterface->findCollectionByUser(
            Auth::id(),
            $request->getOrderDirection() ?: MovieConstant::DEFAULT_ORDER_DIRECTION
        );

        return new GetMoviesByAuthUserResponse($movies);
    }
}
