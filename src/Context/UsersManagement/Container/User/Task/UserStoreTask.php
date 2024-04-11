<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Task;

use App\Context\UsersManagement\Container\User\Contract\UserRepositoryContract;
use App\Context\UsersManagement\Container\User\Model\UserModel;
use App\Shared\Definition\BaseTask;
use App\Shared\Exception\SystemException;

final class UserStoreTask extends BaseTask
{
    public function __construct(
        private readonly UserRepositoryContract $repository
    )
    {}

    public function run(array $data): UserModel
    {
        if (!isset($data['user']) || !$data['user'] instanceof UserModel) {
            throw new SystemException('User data is not valid or missing');
        }

        return $this->repository->createUser($data['user']);
    }
}