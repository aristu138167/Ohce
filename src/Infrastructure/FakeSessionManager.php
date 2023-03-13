<?php

namespace UserLoginService\Infrastructure;

use Exception;
use UserLoginService\Application\SessionManager;

class FakeSessionManager implements SessionManager
{
    public function login(string $userName, string $password): bool
    {
        return $userName=='userName' && $password=='password';
    }

    public function getSessions(): int
    {
        return 0;
    }
}