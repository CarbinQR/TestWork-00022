<?php

declare(strict_types=1);

namespace App\Actions\User;

use Illuminate\Support\Collection;

final class GetAllUsersResponse
{
    private Collection $users;

    public function __construct(Collection $users)
    {
        $this->users = $users;
    }

    public function getResponse(): Collection
    {
        return $this->users;
    }
}
