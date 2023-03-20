<?php
namespace UserLoginService\Infrastructure;

use UserLoginService\Application\SessionManager;

class SessionManagerStub implements SessionManager
{
    public function login(string $userName, string $password): bool
    {
        return true;
    }

    public function getSessions(): int
    {
        return 9;
    }

    public function logout(string $userName): bool
    {
        return true;
    }
}