<?php

namespace UserLoginService\Infrastructure;

use Exception;

class FacebookSessionManagerDummy extends FacebookSessionManager
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
}