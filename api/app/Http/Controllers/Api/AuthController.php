<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\Auth\GetAuthenticatedUserAction;
use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LoginRequest;
use App\Actions\Auth\LogoutAction;
use App\Actions\User\AddUserAction;
use App\Actions\User\AddUserRequest;
use App\Http\Controllers\ApiBaseController;
use App\Http\Presenters\Auth\AuthResponseArrayPresenter;
use App\Http\Presenters\User\UserArrayPresenter;
use App\Http\Requests\Auth\AuthLoginValidatorRequest;
use App\Http\Requests\Auth\AuthSignUpValidatorRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

final class AuthController extends ApiBaseController
{
    public function register(
        AddUserAction $addUserAction,
        LoginAction $loginAction,
        AuthSignUpValidatorRequest $request,
        AuthResponseArrayPresenter $authResponseArrayPresenter
    ): JsonResponse {
        $addUserAction
            ->execute(new AddUserRequest(
                $request->login,
                $request->email,
                $request->password
            ));

        $loggedUser = $loginAction->execute(
            new LoginRequest(
                $request->email,
                $request->password,
            )
        );

        return $this->successResponse($authResponseArrayPresenter->present($loggedUser));
    }

    public function login(
        AuthLoginValidatorRequest $request,
        LoginAction $loginAction,
        AuthResponseArrayPresenter $authResponseArrayPresenter
    ): JsonResponse {
        $loggedUser = $loginAction->execute(
            new LoginRequest(
                $request->email,
                $request->password,
            )
        );

        return $this->successResponse($authResponseArrayPresenter->present($loggedUser));
    }

    public function me(
        GetAuthenticatedUserAction $getAuthenticatedUserAction,
        UserArrayPresenter $userArrayPresenter
    ): JsonResponse {
        $loggedUser = $getAuthenticatedUserAction->execute();

        return $this->successResponse($userArrayPresenter->present($loggedUser->getUser()));
    }

    public function logout(
        LogoutAction $logoutAction
    ): JsonResponse {
        $logoutAction->execute();

        return $this->successResponse(['message' => 'Logged out Successfully.']);
    }
}
