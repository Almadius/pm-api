<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Factory;

use App\Context\UsersManagement\Container\User\Entity\UserDataDoctrineEntity;
use App\Shared\Definition\BaseFactory;

final class UserDataDoctrineEntityFactory extends BaseFactory
{
    protected function defaultValues(): array
    {
        return [
            'deletedAt' => null,
        ];
    }

    protected function getDerivedModel(): string
    {
        return UserDataDoctrineEntity::class;
    }
}