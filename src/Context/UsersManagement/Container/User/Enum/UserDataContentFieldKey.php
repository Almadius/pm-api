<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Enum;

enum UserDataContentFieldKey: string
{
    case Key = 'key';

    case Value = 'value';
}