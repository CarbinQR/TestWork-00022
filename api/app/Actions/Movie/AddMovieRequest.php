<?php

declare(strict_types=1);

namespace App\Actions\Movie;

final class AddMovieRequest
{
    private string $name;

    private bool $isLiked;

    private string $releaseDate;

    private ?string $description;

    public function __construct(
        string  $name,
        bool    $isLiked,
        string  $releaseDate,
        ?string $description,
    )
    {
        $this->name = $name;
        $this->isLiked = $isLiked;
        $this->releaseDate = $releaseDate;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getReleaseDate(): string
    {
        return $this->releaseDate;
    }

    /**
     * @return bool
     */
    public function getIsLiked(): bool
    {
        return $this->isLiked;
    }
}
