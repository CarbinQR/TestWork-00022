<?php

declare(strict_types=1);

namespace App\Exceptions\User;

use Exception;

final class UserNotAuthorizedException extends Exception
{
    public function render()
    {
        return response()->json(
            [
                'success' => false,
                'message' => 'User not authorized!',
            ],
            401
        );
    }
}
