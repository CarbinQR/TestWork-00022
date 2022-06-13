<?php

declare(strict_types=1);

namespace App\Exceptions\User;

use Exception;

final class PageNotFoundException extends Exception
{
    public function render()
    {
        return response()->json(
            [
                "success" => false,
                "message" => $this->getMessage() ?: "Page not found"
            ],
            404
        );
    }
}
