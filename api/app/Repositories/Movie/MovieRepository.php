<?php

namespace App\Repositories\Movie;

use App\Constant\MovieConstant;
use App\Models\Movie;
use Illuminate\Pagination\LengthAwarePaginator;

final class MovieRepository implements MovieRepositoryInterface
{
    public function save(Movie $product): Movie
    {
        $product->save();

        return $product;
    }

    public function update(Movie $product): Movie
    {
        $product->update();

        return $product;
    }

    public function delete(Movie $product): void
    {
        $product->delete();
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
        int     $userId,
        ?string $orderDirection = MovieConstant::DEFAULT_ORDER_DIRECTION
    ): LengthAwarePaginator
    {
        return Movie::where('user_id', $userId)
            ->orderBy(MovieConstant::DEFAULT_ORDER_COLUMN, MovieConstant::DEFAULT_ORDER_DIRECTION)
            ->paginate(MovieConstant::DEFAULT_PER_PAGE);
    }
}
