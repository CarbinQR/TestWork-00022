<?php

declare(strict_types=1);

namespace App\Actions\Movie;

use App\Constant\MovieConstant;
use App\Repositories\Movie\MovieRepositoryInterface;

final class GetAllMoviesAction
{
    private MovieRepositoryInterface $movieRepositoryInterface;

    public function __construct(
        MovieRepositoryInterface $movieRepositoryInterface
    ) {
        $this->movieRepositoryInterface = $movieRepositoryInterface;
    }

    public function execute(GetAllMoviesRequest $request): GetAllMoviesResponse
    {
        $movies = $this->movieRepositoryInterface->getAllWithPaginate(
            $request->getOrderDirection() ?: MovieConstant::DEFAULT_ORDER_DIRECTION
        );

        return new GetAllMoviesResponse($movies);
    }
}
