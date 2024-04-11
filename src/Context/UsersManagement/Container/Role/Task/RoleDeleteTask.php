<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\Role\Task;

use App\Context\UsersManagement\Container\Role\Contract\RoleRepositoryContract;
use App\Context\UsersManagement\Container\Role\Model\RoleModel;
use App\Shared\Definition\BaseTask;
use App\Shared\Exception\SystemException;

final class RoleDeleteTask extends BaseTask
{
    public function __construct(
        private readonly RoleRepositoryContract $repository
    )
    {}

    /**
     * @throws SystemException
     */
    public function run(array $data): void
    {
        if (!isset($data['role']) || !$data['role'] instanceof RoleModel) {
            throw new SystemException('Role is not valid or missing');
        }

        $this->repository->deleteRole($data['role']->getId());
    }
}