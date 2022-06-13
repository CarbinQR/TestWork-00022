<?php

declare(strict_types=1);

namespace App\Exceptions\Movie;

use Exception;

final class MovieNotFoundException extends Exception
{
    public function render()
    {
        return response()->json(
            [
                "success" => false,
                "message" => $this->getMessage() ?: "Movie not found in collection"
            ],
            404
        );
    }
}
