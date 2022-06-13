<?php

namespace App\Repositories\Movie\Criterion;

use Illuminate\Database\Eloquent\Builder;

final class MovieReleaseDateCriterion
{
    private string $releaseDate;

    public function __construct(string $releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->where(
            'release_date',
            $this->releaseDate
        );
    }
}
