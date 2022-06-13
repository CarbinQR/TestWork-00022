<?php

declare(strict_types=1);

namespace App\Actions\Movie;

use App\Exceptions\User\MovieAlreadyExistException;
use App\Models\Movie;
use App\Repositories\Movie\Criterion\UserIdCriterion;
use App\Repositories\Movie\MovieRepositoryInterface;
use App\Repositories\Movie\Criterion\MovieNameCriterion;
use Illuminate\Support\Facades\Auth;

final class AddMovieAction
{
    private MovieRepositoryInterface $movieRepository;

    public function __construct(MovieRepositoryInterface $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function execute(AddMovieRequest $request): AddMovieResponse
    {

        $criteria[] = new MovieNameCriterion($request->getName());
        $criteria[] = new MovieNameCriterion($request->getName());
        $criteria[] = new UserIdCriterion(Auth::id());

        $movie = $this->movieRepository->findByCriteria($criteria);

        if ($movie) {
            throw new MovieAlreadyExistException();
        }

        $newMovie = new Movie();
        $newMovie->name = $request->getName();
        $newMovie->description = $request->getDescription();
        $newMovie->release_date = $request->getReleaseDate();
        $newMovie->is_liked = $request->getIsLiked();
        $newMovie->user_id = Auth::id();

        return new AddMovieResponse(
            $this->movieRepository->save($newMovie)
        );
    }
}
