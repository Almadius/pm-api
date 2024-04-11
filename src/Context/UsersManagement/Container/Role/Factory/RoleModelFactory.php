<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\Role\Factory;

use App\Context\UsersManagement\Container\Role\Model\RoleModel;
use App\Shared\Definition\BaseFactory;

final class RoleModelFactory extends BaseFactory
{
    protected function defaultValues(): array
    {
        return [
            'deletedAt' => null
        ];
    }

    protected function getDerivedModel(): string
    {
        return RoleModel::class;
    }
}