<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Task;

use App\Context\UsersManagement\Container\User\Contract\UserRepositoryContract;
use App\Context\UsersManagement\Container\User\Model\UserModel;
use App\Shared\Definition\BaseTask;
use App\Shared\Exception\SystemException;

final class UserFillDataByUuidTask extends BaseTask
{
    public function __construct(
        private readonly UserRepositoryContract $repository
    )
    {}

    /**
     * @throws SystemException
     */
    public function run(array $data): UserModel
    {
        if (!array_key_exists('uuid', $data)) {
            throw new SystemException('Uuid is not given for ' . self::class);
        }

        return $this->repository->filterUsersBy($data)[0];
    }
}