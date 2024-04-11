<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Contract;

use App\Context\UsersManagement\Container\User\Model\UserModel;
use App\Shared\Contract\AutoSyncTunableContract;
use App\Shared\Definition\BaseContract;

interface UserRepositoryContract extends BaseContract, AutoSyncTunableContract
{
    public function createUser(UserModel $model): UserModel;

    public function deleteUser(int $userId);

    /**
     * @param array $filters
     * @return array<UserModel>
     */
    public function filterUsersBy(array $filters): array;

    public function updateUser(UserModel $model);

    public function syncWithDataSource(): void;
}