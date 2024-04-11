<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Task;

use App\Context\UsersManagement\Container\User\Contract\UserDataRepositoryContract;
use App\Context\UsersManagement\Container\User\Enum\UserPersonalDataKey;
use App\Context\UsersManagement\Container\User\Model\UserModel;
use App\Shared\Definition\BaseTask;
use App\Shared\Exception\SystemException;

final class UserDataStoreTask extends BaseTask
{
    public function __construct(
        private readonly UserDataRepositoryContract $repository
    )
    {}

    /**
     * @throws SystemException
     */
    public function run(array $data)
    {
        if (!isset($data['user']) || !$data['user'] instanceof UserModel) {
            throw new SystemException('User data is not valid or missing');
        }

        $this->repository->turnOffAutoSync();

        foreach($data['user']->getPersonalData() as $dataKey => $dataValue) {
            if (!in_array($dataKey, array_map(fn($enumItem) => $enumItem->value, UserPersonalDataKey::cases()))) {
                throw new SystemException('Undefined personal data key');
            }

            $this->repository->createUserData(
                [
                    'userId' => $data['user']->getId(),
                    'key' => $dataKey,
                    'value' => $dataValue
                ]
            );
        }

        $this->repository->syncWithDataSource();
    }
}