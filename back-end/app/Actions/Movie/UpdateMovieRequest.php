<?php

declare(strict_types=1);

namespace App\Actions\Movie;

final class UpdateMovieRequest
{
    private int $movieId;

    private string $name;

    private bool $isLiked;

    private string $releaseDate;

    private ?string $description;

    public function __construct(
        int $movieId,
        string $name,
        bool $isLiked,
        string $releaseDate,
        ?string $description,
    ) {
        $this->movieId = $movieId;
        $this->name = $name;
        $this->isLiked = $isLiked;
        $this->releaseDate = $releaseDate;
        $this->description = $description;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    public function getIsLiked(): bool
    {
        return $this->isLiked;
    }

    public function getMovieId(): int
    {
        return $this->movieId;
    }
}
