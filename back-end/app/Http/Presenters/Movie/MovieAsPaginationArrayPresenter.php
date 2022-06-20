<?php

declare(strict_types=1);

namespace App\Http\Presenters\Movie;

use App\Http\Presenters\User\UserArrayPresenter;
use App\Models\Movie;
use Illuminate\Pagination\LengthAwarePaginator;

class MovieAsPaginationArrayPresenter
{
    private UserArrayPresenter $userPresenter;

    public function __construct()
    {
        $this->userPresenter = new UserArrayPresenter();
    }

    public function present(Movie $movie): array
    {
        return [
            'id' => $movie->getId(),
            'name' => $movie->getName(),
            'description' => $movie->getDescription(),
            'releaseDate' => $movie->getReleaseDate(),
            'isLiked' => $movie->getIsLiked(),
            'author' => $movie->author ?
                $this->userPresenter->present($movie->author)
                : [],
        ];
    }

    public function presentCollection(LengthAwarePaginator $paginator): array
    {
        $result['items'] = collect($paginator->items())
            ->map(
                fn (Movie $movie) => $this->present($movie)
            )
            ->all();
        $result['previousPageUrl'] = $paginator->previousPageUrl();
        $result['nextPageUrl'] = $paginator->nextPageUrl();
        $result['perPage'] = $paginator->perPage();
        $result['total'] = $paginator->total();
        $result['currentPage'] = $paginator->currentPage();
        $result['lastPage'] = $paginator->lastPage();

        return $result;
    }
}
