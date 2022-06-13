<?php

namespace App\Http\Presenters\Auth;

use App\Actions\Auth\LoginResponse;

final class AuthResponseArrayPresenter
{
    public function present(LoginResponse $response): array
    {
        return [
            'accessToken' => $response->getAccessToken(),
            'tokenType' => $response->getTokenType(),
            'expiresIn' => $response->getExpiresIn(),
        ];
    }
}
