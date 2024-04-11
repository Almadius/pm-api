<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Enum;

enum UserDataStatus: int
{
    // The status is used after creation in the table
    case NotConfirmed = 1;

    // The status used after phone has been confirmed
    case Active = 2;

    // That status used after login selected
    case Old = 3;
}