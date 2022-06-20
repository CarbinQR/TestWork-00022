<?php

declare(strict_types=1);

namespace App\Repositories\Movie\Criterion;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

final class MovieNameCriterion
{
    private string $movieName;

    public function __construct(string $movieName)
    {
        $this->movieName = $movieName;
    }

    public function apply(Builder $builder): Builder
    {
        return $builder->where(
            DB::raw('LOWER(name)'),
            'like',
            "%{$this->movieName}%"
        );
    }
}
