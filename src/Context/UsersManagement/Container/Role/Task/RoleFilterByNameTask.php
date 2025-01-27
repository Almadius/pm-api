<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\Role\Task;

use App\Context\UsersManagement\Container\Role\Contract\RoleRepositoryContract;
use App\Context\UsersManagement\Container\Role\Model\RoleModel;
use App\Shared\Definition\BaseTask;
use App\Shared\Exception\SystemException;

final class RoleFilterByNameTask extends BaseTask
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
        if (!isset($data['name'])) {
            throw new SystemException('Filter name is not provided for role task');
        }

        $this->repository->filterRolesBy(['name' => $data['name']])[0];
    }
}