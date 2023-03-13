<?php

namespace UserLoginService\Application;

use Exception;
use UserLoginService\Domain\User;
use UserLoginService\Infrastructure\FacebookSessionManager;
use UserLoginService\Infrastructure\SessionManagerStub;

class UserLoginService
{
    private array $loggedUsers = [];
    private SessionManager $sessionManager;

    /**
     * @param SessionManager $sessionManager
     */
    public function __construct(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }


    /**
     * @throws Exception
     */
    public function manualLogin(User $user): void
    {
        if(in_array($user, $this->loggedUsers)) {
            throw new Exception('User alredy logged in');
        }
        else{
            $this->loggedUsers[]=$user;
        }
    }

    public function getLoggerUsers(): array
    {
        return $this->loggedUsers;
    }

    public function getExternalSessions(): int
    {
        return $this->sessionManager->getSessions();
    }
    public function setExternalSessions(FacebookSessionManager $facebook_session_manager): void
    {
        $this->sessionManager= $facebook_session_manager;
    }

    /**
     * @throws Exception
     */
    public function login(string $userName, string $password): string
    {
        if($this->sessionManager->login($userName, $password)) {
            $this->loggedUsers[]=new User($userName);
            return "Login correcto";
        }
        else{
            return "Login incorrecto";
        }
    }


}