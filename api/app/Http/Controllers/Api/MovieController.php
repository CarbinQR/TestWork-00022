<?php

namespace App\Http\Controllers\Api;

use App\Actions\Movie\AddMovieAction;
use App\Actions\Movie\AddMovieRequest;
use App\Actions\Movie\DeleteMovieAction;
use App\Actions\Movie\DeleteMovieRequest;
use App\Actions\Movie\GetMovieByIdAction;
use App\Actions\Movie\GetMovieByIdRequest;
use App\Actions\Movie\GetMoviesByUserAction;
use App\Actions\Movie\GetMoviesByUserRequest;
use App\Actions\Movie\UpdateMovieAction;
use App\Actions\Movie\UpdateMovieRequest;
use App\Http\Controllers\ApiBaseController;
use App\Http\Presenters\Movie\MovieAsArrayPresenter;
use App\Http\Presenters\Movie\MovieAsPaginationArrayPresenter;
use App\Http\Requests\Movie\CreateMovieValidateRequest;
use App\Http\Requests\Movie\DeleteMovieValidateRequest;
use App\Http\Requests\Movie\UpdateMovieValidateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class MovieController extends ApiBaseController
{
    public function getByAuthUser(
        GetMoviesByUserAction           $getMoviesByUserAction,
        MovieAsPaginationArrayPresenter $movieAsPaginateArrayPresenter,
        Request                         $request
    ): JsonResponse
    {
        $movies = $getMoviesByUserAction
            ->execute(new GetMoviesByUserRequest(
                $request->input('orderDirection')
            ))
            ->getResponse();

        return $this->successResponse(
            $movieAsPaginateArrayPresenter->presentCollection($movies)
        );
    }

    public function getById(
        GetMovieByIdAction    $getMovieByIdAction,
        MovieAsArrayPresenter $presenter,
        string                $id
    ): JsonResponse
    {
        $movie = $getMovieByIdAction
            ->execute(new GetMovieByIdRequest(
                (int)$id
            ))
            ->getResponse();

        return $this->successResponse(
            $presenter->present($movie)
        );
    }

    public function create(
        AddMovieAction             $addMovieAction,
        CreateMovieValidateRequest $request
    ): JsonResponse
    {
        $addMovieAction
            ->execute(new AddMovieRequest(
                $request->get('name'),
                $request->get('isLiked'),
                $request->get('releaseDate'),
                $request->get('description')
            ))
            ->getResponse();

        return $this->successResponse(['message' => 'OK']);
    }

    public function update(
        UpdateMovieAction               $updateMovieAction,
        MovieAsPaginationArrayPresenter $movieAsPaginationArrayPresenter,
        UpdateMovieValidateRequest      $request,
    ): JsonResponse
    {
        $updatedMovie = $updateMovieAction
            ->execute(new UpdateMovieRequest(
                (int)$request->get('id'),
                $request->get('name'),
                $request->get('isLiked'),
                $request->get('releaseDate'),
                $request->get('description')
            ))
            ->getResponse();

        return $this->successResponse($movieAsPaginationArrayPresenter->present($updatedMovie));
    }

    public function delete(
        DeleteMovieValidateRequest $request,
        DeleteMovieAction          $deleteMovieAction
    ): JsonResponse
    {
        $deleteMovieAction
            ->execute(new DeleteMovieRequest(
                (int)$request->get('id')
            ));

        return $this->successResponse(['message' => 'OK']);
    }
}
