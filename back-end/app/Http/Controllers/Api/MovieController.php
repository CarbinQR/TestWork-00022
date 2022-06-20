<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Actions\Movie\AddMovieAction;
use App\Actions\Movie\AddMovieRequest;
use App\Actions\Movie\DeleteMovieAction;
use App\Actions\Movie\DeleteMovieRequest;
use App\Actions\Movie\GetAllMoviesAction;
use App\Actions\Movie\GetAllMoviesRequest;
use App\Actions\Movie\GetMovieByIdAction;
use App\Actions\Movie\GetMovieByIdRequest;
use App\Actions\Movie\GetMoviesByAuthUserAction;
use App\Actions\Movie\GetMoviesByAuthUserRequest;
use App\Actions\Movie\UpdateMovieAction;
use App\Actions\Movie\UpdateMovieRequest;
use App\Http\Controllers\ApiBaseController;
use App\Http\Presenters\Movie\MovieAsArrayPresenter;
use App\Http\Presenters\Movie\MovieAsPaginationArrayPresenter;
use App\Http\Requests\Movie\CreateMovieValidateRequest;
use App\Http\Requests\Movie\UpdateMovieValidateRequest;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class MovieController extends ApiBaseController
{
    public function getByAuthUser(
        GetMoviesByAuthUserAction $getMoviesByAuthUserAction,
        MovieAsPaginationArrayPresenter $movieAsPaginateArrayPresenter,
        Request $request
    ): JsonResponse {
        $movies = $getMoviesByAuthUserAction
            ->execute(new GetMoviesByAuthUserRequest(
                $request->input('orderDirection')
            ))
            ->getResponse();

        return $this->successResponse(
            $movieAsPaginateArrayPresenter->presentCollection($movies)
        );
    }

    public function index(
        GetAllMoviesAction $getAllMoviesAction,
        MovieAsPaginationArrayPresenter $movieAsPaginateArrayPresenter,
        Request $request
    ): JsonResponse {
        $movies = $getAllMoviesAction
            ->execute(new GetAllMoviesRequest(
                $request->input('orderDirection')
            ))
            ->getResponse();

        return $this->successResponse(
            $movieAsPaginateArrayPresenter->presentCollection($movies)
        );
    }

    public function show(
        GetMovieByIdAction $getMovieByIdAction,
        MovieAsArrayPresenter $presenter,
        string $movie
    ): JsonResponse {
        $fetchedMovie = $getMovieByIdAction
            ->execute(new GetMovieByIdRequest(
                (int)$movie
            ))
            ->getResponse();

        return $this->successResponse(
            $presenter->present($fetchedMovie)
        );
    }

    public function store(
        AddMovieAction $addMovieAction,
        CreateMovieValidateRequest $request
    ): JsonResponse {
        $addMovieAction
            ->execute(new AddMovieRequest(
                $request->get('name'),
                (bool)$request->get('isLiked'),
                $request->get('releaseDate'),
                $request->get('description')
            ))
            ->getResponse();

        return $this->successResponse(['message' => 'OK']);
    }

    public function update(
        UpdateMovieAction $updateMovieAction,
        MovieAsPaginationArrayPresenter $movieAsPaginationArrayPresenter,
        UpdateMovieValidateRequest $request,
        string $movie,
    ): JsonResponse {
        $this->authorize('update', Movie::class);
        $updatedMovie = $updateMovieAction
            ->execute(new UpdateMovieRequest(
                (int)$movie,
                $request->get('name'),
                (bool)$request->get('isLiked'),
                $request->get('releaseDate'),
                $request->get('description')
            ))
            ->getResponse();

        return $this->successResponse($movieAsPaginationArrayPresenter->present($updatedMovie));
    }

    public function destroy(
        DeleteMovieAction $deleteMovieAction,
        string $movie
    ): JsonResponse {
        $deleteMovieAction
            ->execute(new DeleteMovieRequest(
                (int)$movie
            ));

        return $this->successResponse(['message' => 'OK']);
    }
}
