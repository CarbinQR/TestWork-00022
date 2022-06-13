<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;

final class LogoutAction
{

    public function execute(): void
    {
        $this->guard()->logout();
    }

    private function guard()
    {
        return Auth::guard();
    }
}
