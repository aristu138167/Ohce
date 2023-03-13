<?php

namespace UserLoginService\Application;

use Exception;
use UserLoginService\Domain\User;
use UserLoginService\Infrastructure\FacebookSessionManager;

class UserLoginService
{
    private array $loggedUsers = [];
    private FacebookSessionManager $facebookSessionManager;

    /**
     * @throws Exception
     */
    public function manualLogin(User $user): void
    {
        if(in_array($user,$this->loggedUsers)) {
            throw new Exception('User alredy logged in');
        }
        else{
            $this->loggedUsers[]=$user;
        }
    }

    public function getLoggerUsers(): array{
        return $this->loggedUsers;
    }

    public function getExternalSessions(): int
    {
        $facebookSessionManager= new FacebookSessionManager();
        return 0;
    }

}