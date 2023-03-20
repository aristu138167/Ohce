<?php

namespace UserLoginService\Infrastructure;

use Exception;
use UserLoginService\Application\SessionManager;

class SessionManagerDummy implements SessionManager
{
    /**
     * @throws Exception
     */
    public function login(string $userName, string $password): bool
    {
        throw new Exception;
    }

    /**
     * @throws Exception
     */
    public function getSessions(): int
    {
        throw new Exception;
    }

    /**
     * @throws Exception
     */
    public function logout(string $userName): bool
    {
        throw new Exception;
    }
}