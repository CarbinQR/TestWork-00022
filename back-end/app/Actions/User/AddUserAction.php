<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

final class AddUserAction
{
    private UserRepositoryInterface $userRepositoryInterface;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function execute(AddUserRequest $request): void
    {
        $newUser = new User();
        $newUser->login = $request->getLogin();
        $newUser->email = $request->getEmail();
        $newUser->password = bcrypt($request->getPassword());

        $this->userRepositoryInterface->save($newUser);
    }
}
