<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Factory;

use App\Context\UsersManagement\Container\User\Enum\UserStatus;
use App\Context\UsersManagement\Container\User\Model\UserModel;
use App\Shared\Definition\BaseFactory;
use Ramsey\Uuid\Uuid;

final class UserModelFactory extends BaseFactory
{
    protected function defaultValues(): array
    {
        return [
            'uuid' => Uuid::uuid4()->toString(),
            'status' => UserStatus::JustCreated->value,
        ];
    }

    protected function getDerivedModel(): string
    {
        return UserModel::class;
    }
}