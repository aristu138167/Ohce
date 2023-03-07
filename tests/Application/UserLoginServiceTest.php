<?php

declare(strict_types=1);

namespace UserLoginService\Tests\Application;

use Exception;
use PHPUnit\Framework\TestCase;
use UserLoginService\Application\UserLoginService;
use UserLoginService\Domain\User;

final class UserLoginServiceTest extends TestCase
{
    /**
     * @test
     */
    public function userIsManuallyLoggedIn()
    {
        $userLoginService = new UserLoginService();
        $user=new User("name");

        $userLoginService->manualLogin($user);

        $this->assertContains($user,$userLoginService->getLoggerUsers());
    }

    /**
     * @test
     * @throws Exception
     */
    public function errorWhileLoginUserIfIsAlredyLoggedIn()
    {
        $userLoginService = new UserLoginService();
        $user=new User("name");



        $this->expectException(Exception::class);
        $this->expectExceptionMessage('User alredy logged in');

        $userLoginService->manualLogin($user);
        $userLoginService->manualLogin($user);
    }

    /**
     * @test
     */
    public function xUsersInExternalSessions()
    {
        $userLoginService = new UserLoginService();

        $userLoginService->getExternalSessions();

        $this->assert
    }
}
