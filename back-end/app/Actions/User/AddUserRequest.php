<?php

declare(strict_types=1);

namespace App\Actions\User;

final class AddUserRequest
{
    private string $login;

    private string $email;

    private string $password;

    public function __construct(
        string $login,
        string $email,
        string $password
    ) {
        $this->login = $login;
        $this->email = $email;
        $this->password = $password;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
