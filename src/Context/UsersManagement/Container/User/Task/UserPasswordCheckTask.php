<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Task;

use App\Shared\Definition\BaseTask;
use App\Context\UsersManagement\Container\User\Model\UserModel;
use InvalidArgumentException;

final class UserPasswordCheckTask extends BaseTask
{
    public function run(array $data): bool
    {
        if (!isset($data['user']) || !$data['user'] instanceof UserModel) {
            throw new InvalidArgumentException('User data is not valid or missing');
        }

        $user = $data['user'];
        $password = $data['password'] ?? '';

        return password_verify($password, $user->getPassword());
    }
}