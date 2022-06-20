<?php

declare(strict_types=1);

namespace App\Exceptions\Auth;

use Exception;

final class AuthenticationException extends Exception
{
    public function render()
    {
        return response()->json(
            [
                'success' => false,
                'message' => $this->getMessage() ?: 'Invalid email or password',
                'code' => 409,
            ],
            409
        );
    }
}
