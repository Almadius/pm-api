<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Enum;

enum UserPersonalDataKey: string
{
    case FirstName = 'firstName';

    case LastName = 'lastName';

    case Phone = 'phone';

    case Email = 'email';
}