<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Exceptions\User\UserNotFoundException;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

final class LoginAction
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(LoginRequest $request): LoginResponse
    {
        $userByEmail = $this->userRepository->getByEmail($request->getEmail());

        if (!$userByEmail) {
            throw new UserNotFoundException();
        }

        $credentials = [
            'email' => $request->getEmail(),
            'password' => $request->getPassword(),
        ];

        $token = $this->guard()->attempt($credentials);

        if (!$token) {
            throw new AuthenticationException();
        }

        return new LoginResponse(
            $token,
            'bearer',
            auth()->factory()->getTTL() * 1440
        );
    }

    private function guard()
    {
        return Auth::guard();
    }
}
