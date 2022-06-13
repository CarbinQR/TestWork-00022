<?php

namespace App\Repositories\Movie;

use App\Models\Movie;
use Illuminate\Pagination\LengthAwarePaginator;

interface MovieRepositoryInterface
{
    public function save(Movie $product): Movie;

    public function update(Movie $product): Movie;

    public function delete(Movie $product): void;

    public function getById(int $productId): ?Movie;

    public function findByCriteria(array $criteria): ?Movie;

    public function findCollectionByUser(int $userId, string $orderDirection): LengthAwarePaginator;
}
