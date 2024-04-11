<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\Role\Task;

use App\Context\UsersManagement\Container\Role\Contract\RoleRepositoryContract;
use App\Context\UsersManagement\Container\Role\Model\RoleModel;
use App\Shared\Definition\BaseTask;
use App\Shared\Exception\SystemException;

final class RoleStoreTask extends BaseTask
{
    public function __construct(
        private readonly RoleRepositoryContract $repository
    )
    {}

    /**
     * @throws SystemException
     */
    public function run(array $data): RoleModel
    {
        if (!isset($data['role']) || !$data['role'] instanceof RoleModel) {
            throw new SystemException('Role is not valid or missing');
        }

        return $this->repository->createRole($data['role']);
    }
}