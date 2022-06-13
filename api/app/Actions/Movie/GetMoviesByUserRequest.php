<?php

declare(strict_types=1);

namespace App\Actions\Movie;

final class GetMoviesByUserRequest
{
    private ?string $orderDirection;

    public function __construct(?string $orderDirection)
    {
        $this->orderDirection = $orderDirection;
    }

    public function getOrderDirection(): ?string
    {
        return $this->orderDirection;
    }
}
