<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Factory;

use App\Context\UsersManagement\Container\User\Entity\UserDoctrineEntity;
use App\Shared\Definition\BaseFactory;

final class UserDoctrineEntityFactory extends BaseFactory
{
    protected function defaultValues(): array
    {
        return [
            'deletedAt' => null,
        ];
    }

    protected function getDerivedModel(): string
    {
        return UserDoctrineEntity::class;
    }
}