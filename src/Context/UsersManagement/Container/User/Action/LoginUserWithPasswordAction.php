<?php

namespace App\Context\UsersManagement\Container\User\Action;

use App\Context\UsersManagement\Container\User\Task\CredentialsCheckTask;
use App\Context\UsersManagement\Container\User\Task\UserFilterByLoginTask;
use App\Context\UsersManagement\Container\User\Task\UserSessionCreateTask;
use App\Shared\Definition\BaseAction;
use App\Shared\Definition\ActionResult;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

final class LoginUserWithPasswordAction extends BaseAction
{
    public function __construct(
        private readonly JWTTokenManagerInterface $JWTTokenManager,
        private readonly UserFilterByLoginTask $userFilterByLoginTask,
        private readonly CredentialsCheckTask     $credentialsCheckTask,
        private readonly UserSessionCreateTask $userSessionCreateTask
    ) {
    }

    public function run(array $data): ActionResult
    {
        // Add attempts number
        $userData = [];

        $user = $this
            ->credentialsCheckTask
            ->run(
                [
                    'login' => $data['phone'],
                    'password' => $data['password']
                ]
            );

        // If attempt is successful -> set attempts to 0

        $user = $this->userFilterByLoginTask->run(['login' => $data]);

        $jwtToken = $this->JWTTokenManager->create($user);

        return new ActionResult([
            'authToken' => $jwtToken,
            'user' => $user->getPublicData()
        ]);
    }
}