<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Exceptions\User\UserNotAuthorizedException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @throws UserNotAuthorizedException
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            throw new UserNotAuthorizedException();
        }
    }
}
