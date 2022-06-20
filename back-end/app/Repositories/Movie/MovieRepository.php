<?php

declare(strict_types=1);

namespace App\Repositories\Movie;

use App\Constant\MovieConstant;
use App\Exceptions\Movie\MovieNotFoundException;
use App\Models\Movie;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

final class MovieRepository implements MovieRepositoryInterface
{
    public function getAllWithPaginate(
        ?string $orderDirection = MovieConstant::DEFAULT_ORDER_DIRECTION
    ): LengthAwarePaginator {
        return Movie::orderBy(MovieConstant::DEFAULT_ORDER_COLUMN, $orderDirection)
            ->paginate(MovieConstant::DEFAULT_PER_PAGE);
    }

    public function save(Movie $movie): Movie
    {
        Auth::user()->movies()->save($movie);

        return $movie;
    }

    public function update(Movie $movie): Movie
    {
        if (!policy(Movie::class)->update($movie)) {
            throw new MovieNotFoundException();
        }

        $movie->update();

        return $movie;
    }

    public function delete(Movie $movie): void
    {
        $movie->delete();
    }

    public function getById(int $id): ?Movie
    {
        return Movie::firstWhere('id', $id);
    }

    public function findByCriteria(array $criteria): ?Movie
    {
        $query = Movie::query();

        foreach ($criteria as $criterion) {
            $query = $criterion->apply($query);
        }

        return $query->select('movies.*')
            ->first();
    }

    public function findCollectionByUser(
        int $userId,
        ?string $orderDirection = MovieConstant::DEFAULT_ORDER_DIRECTION
    ): LengthAwarePaginator {
        return Movie::where('user_id', $userId)
            ->orderBy(MovieConstant::DEFAULT_ORDER_COLUMN, $orderDirection)
            ->paginate(MovieConstant::DEFAULT_PER_PAGE);
    }
}
