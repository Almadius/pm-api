<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\Role\Factory;

use App\Context\UsersManagement\Container\Role\Entity\RoleDoctrineEntity;
use App\Shared\Definition\BaseFactory;

final class RoleDoctrineEntityFactory extends BaseFactory
{
    protected function defaultValues(): array
    {
        return [
            'deletedAt' => null
        ];
    }

    protected function getDerivedModel(): string
    {
        return RoleDoctrineEntity::class;
    }
}