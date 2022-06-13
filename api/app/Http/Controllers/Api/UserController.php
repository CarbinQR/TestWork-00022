<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiBaseController;
use Illuminate\Http\JsonResponse;
use App\Actions\User\GetAllUsersAction;
use App\Actions\User\GetUserByIdAction;
use App\Actions\User\GetUserByIdRequest;
use App\Http\Presenters\User\UserArrayPresenter;

final class UserController extends ApiBaseController
{
    public function getAllUsers(
        GetAllUsersAction $getAllUsersAction,
        UserArrayPresenter $userArrayPresenter
    ): JsonResponse {
        $users = $getAllUsersAction
            ->execute()
            ->getResponse();
        $presenter = $userArrayPresenter->presentCollection($users);

        return $this->successResponse($presenter);
    }
    public function getUserById(
        GetUserByIdAction $getUserByIdAction,
        UserArrayPresenter $userArrayPresenter,
        string $userId
    ): JsonResponse {
        $user = $getUserByIdAction
            ->execute(new GetUserByIdRequest((int) $userId))
            ->getResponse();
        $presenter = $userArrayPresenter->present($user);

        return $this->successResponse($presenter);
    }
}
