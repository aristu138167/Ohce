<?php

declare(strict_types=1);

namespace UserLoginService\Tests\Application;

use Exception;
use PHPUnit\Framework\TestCase;
use UserLoginService\Application\UserLoginService;
use UserLoginService\Domain\User;
use UserLoginService\Infrastructure\FakeSessionManager;
use UserLoginService\Infrastructure\SessionManagerDummy;
use UserLoginService\Infrastructure\SessionManagerStub;

final class UserLoginServiceTest extends TestCase
{
    /**
     * @test
     * @throws Exception
     */
    public function userIsManuallyLoggedIn()
    {
        $userLoginService = new UserLoginService(new SessionManagerDummy());
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
        $userLoginService = new UserLoginService(new SessionManagerDummy());
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
        $userLoginService = new UserLoginService(new SessionManagerStub());
        $this->assertEquals(9, $userLoginService->getExternalSessions());
    }

    /**
     * @test
     * @throws Exception
     */
    public function externalLogin()
    {
        $userLoginService = new UserLoginService(new FakeSessionManager());
        $loginStatus=$userLoginService->login("userName", "password");
        $this->assertEquals("Login correcto", $loginStatus);
        //$this->assertContains(new User("userName"), $userLoginService->getLoggerUsers());
    }


}
