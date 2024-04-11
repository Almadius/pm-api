<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Task;

use App\Shared\Definition\BaseTask;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\RequestStack;

final class UserSessionCreateTask extends BaseTask
{
    public function __construct(
        private RequestStack $requestStack,
    )
    {
    }

    public function run(array $data): string
    {
        $sessionId = Uuid::uuid4()->toString();

        $user = $data['user'];
        $userId = $user->getId();

        $sessionData = [
            'user_id' => $userId,
            'created_at' => new \DateTime(),
        ];

        $this->requestStack->getSession(); //($sessionId, $sessionData);

        return $sessionId;
    }
}