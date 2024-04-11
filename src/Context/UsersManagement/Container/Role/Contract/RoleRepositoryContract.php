<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\Role\Contract;

use App\Context\UsersManagement\Container\Role\Model\RoleModel;
use App\Shared\Contract\AutoSyncTunableContract;
use App\Shared\Definition\BaseContract;

interface RoleRepositoryContract extends BaseContract, AutoSyncTunableContract
{
    public function createRole(RoleModel $model): RoleModel;

    public function deleteRole(int $roleId): void;

    /**
     * @param array $filters
     * @return array<RoleModel>
     */
    public function filterRolesBy(array $filters): array;

    public function updateRole(RoleModel $model): RoleModel;

    public function syncWithDataSource(): void;
}