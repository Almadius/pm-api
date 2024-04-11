<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Task;

use App\Shared\Definition\BaseTask;

final class UserLogoutTask extends BaseTask
{
    public function run(array $data): void
    {
        $userId = $data['user_id'] ?? null;

        if (!$userId) {
            throw new \InvalidArgumentException("No active session found for logout.");
        }
    }
}
