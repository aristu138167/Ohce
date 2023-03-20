<?php

declare(strict_types=1);

namespace UserLoginService\Tests\Application;

use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;
use UserLoginService\Application\SessionManager;
use UserLoginService\Application\UserLoginService;
use UserLoginService\Domain\User;

final class UserLoginServiceTest extends TestCase
{
    /**
     * @test
     * @throws Exception
     */
    public function userIsManuallyLoggedIn()
    {   $sessionManager=Mockery::mock(SessionManager::class);
        $userLoginService = new UserLoginService($sessionManager);
        $user=new User("name");

        $userLoginService->manualLogin($user);

        $this->assertContains($user, $userLoginService->getLoggerUsers());
    }

    /**
     * @test
     * @throws Exception
     */
    public function errorWhileLoginUserIfIsAlredyLoggedIn()
    {
        $sessionManager=Mockery::mock(SessionManager::class);
        $userLoginService = new UserLoginService($sessionManager);
        $user=new User("name");



        $this->expectException(Exception::class);
        $this->expectExceptionMessage('User alredy logged in');

        $userLoginService->manualLogin($user);
        $userLoginService->manualLogin($user);
    }

    /**
     * @test
     */
    public function externalSessions()
    {
        $sessionManager=Mockery::mock(SessionManager::class);
        $userLoginService = new UserLoginService($sessionManager);

        $sessionManager->allows()->getSessions()->andReturns(9);

        $externalSessions=$userLoginService->getExternalSessions();

        $this->assertEquals(9, $externalSessions);
    }

    /**
     * @test
     * @throws Exception
     */
    public function externalLoginCorrecto()
    {
        $sessionManager=Mockery::mock(SessionManager::class);
        $userLoginService = new UserLoginService($sessionManager);

        $sessionManager->allows()->login("userName", "password");

        $loginStatus=$userLoginService->login("userName", "password");



        $this->assertEquals("Login correcto", $loginStatus);
        //$this->assertContains(new User("userName"), $userLoginService->getLoggerUsers());
    }

    /**
     * @test
     * @throws Exception
     */
    public function externalLogoutIncorrecto()
    {
        $sessionManager=Mockery::spy(SessionManager::class);
        $userLoginService = new UserLoginService($sessionManager);
        $user=new User("userName");

        $logoutStatus=$userLoginService->logout($user);

        $sessionManager->shouldNotHaveReceived()->logout($user);

        $this->assertEquals("User not found", $logoutStatus);
    }

    /**
     * @test
     * @throws Exception
     */
    public function externalLogoutCorrecto()
    {
        $sessionManager=Mockery::spy(SessionManager::class);
        $userLoginService = new UserLoginService($sessionManager);
        $user=new User("userName");
        $userLoginService->manualLogin($user);

        $logoutStatus=$userLoginService->logout($user);

        $sessionManager->shouldReceive()->logout($user->getUserName());

        $this->assertEquals("Ok", $logoutStatus);
    }

}
