<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\User\GetAllUsersAction;
use App\Actions\User\GetUserByIdAction;
use App\Actions\User\GetUserByIdRequest;
use App\Http\Controllers\ApiBaseController;
use App\Http\Presenters\User\UserArrayPresenter;
use Illuminate\Http\JsonResponse;

final class UserController extends ApiBaseController
{
    public function getAll(
        GetAllUsersAction $getAllUsersAction,
        UserArrayPresenter $userArrayPresenter
    ): JsonResponse {
        $users = $getAllUsersAction
            ->execute()
            ->getResponse();
        $presenter = $userArrayPresenter->presentCollection($users);

        return $this->successResponse($presenter);
    }

    public function getByUserId(
        GetUserByIdAction $getUserByIdAction,
        UserArrayPresenter $userArrayPresenter,
        string $id
    ): JsonResponse {
        $user = $getUserByIdAction
            ->execute(new GetUserByIdRequest((int)$id))
            ->getResponse();
        $presenter = $userArrayPresenter->present($user);

        return $this->successResponse($presenter);
    }
}
