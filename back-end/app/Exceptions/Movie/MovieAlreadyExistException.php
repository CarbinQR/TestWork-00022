<?php

declare(strict_types=1);

namespace App\Exceptions\Movie;

use Exception;

final class MovieAlreadyExistException extends Exception
{
    public function render()
    {
        return response()->json(
            [
                'success' => false,
                'message' => $this->getMessage() ?: 'Movie already exist in collection',
            ],
            409
        );
    }
}
