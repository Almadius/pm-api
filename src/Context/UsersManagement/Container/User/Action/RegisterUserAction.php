<?php

namespace App\Context\UsersManagement\Container\User\Action;

use App\Context\UsersManagement\Container\User\Factory\UserModelFactory;
use App\Context\UsersManagement\Container\User\Task\UserStoreTask;
use App\Shared\Definition\BaseAction;
use App\Shared\Definition\ActionResult;
use App\Shared\Exception\ScenarioException;
use App\Shared\Support\Authenticator\Event\ProxyAuthenticationSuccessEvent;
use App\Shared\Task\CommitTransactionTask;
use App\Shared\Task\RollbackTransactionTask;
use App\Shared\Task\StartTransactionTask;
use Exception;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class RegisterUserAction extends BaseAction
{
    public function __construct(
        private readonly UserStoreTask            $userStoreTask,
        private readonly JWTTokenManagerInterface $JWTTokenManager,
        private readonly UserModelFactory         $userFactory,
        private readonly StartTransactionTask     $startTransactionTask,
        private readonly RollbackTransactionTask  $rollbackTransactionTask,
        private readonly CommitTransactionTask    $commitTransactionTask,
        private readonly EventDispatcherInterface $eventDispatcher,
    )
    {
    }

    /**
     * @throws ScenarioException
     */
    public function run(array $data): ActionResult
    {
        $this->setPhoneAsLogin($data);

        $user = $this->userFactory->build($data);

        try {
            $this->startTransactionTask->run();

            $user = $this->userStoreTask->run(['user' => $user]);

            $this->eventDispatcher->dispatch(new ProxyAuthenticationSuccessEvent([], $user));

            $authToken = $this->JWTTokenManager->create($user);
        } catch (Exception $e) {
            $this->rollbackTransactionTask->run();

            throw new ScenarioException("Error during user registration: " . $e->getMessage());
        }

        $this->commitTransactionTask->run();

        return new ActionResult([
            'user' => $user->getPublicData(),
            'authToken' => $authToken,
        ]);
    }

    private function setPhoneAsLogin(array &$data): void
    {
        $data['login'] = $data['phone'];
    }
}