<?php
namespace UserLoginService\Infrastructure;

use UserLoginService\Application\SessionManager;

class Stub_FacebookSessionManager extends FacebookSessionManager
{
    public function login(string $userName, string $password): bool
    {
        //Imaginad que esto en realidad realiza una llamada al API de Facebook
        return rand(0, 1) == 1;
    }

    public function getSessions(): int
    {
        //Imaginad que esto en realidad realiza una llamada al API de Facebook
        return rand(0, 100);
    }
}