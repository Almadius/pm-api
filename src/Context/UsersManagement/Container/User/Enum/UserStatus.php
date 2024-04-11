<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\Enum;

enum UserStatus: int
{
    // The status is used after creation in the table
    case JustCreated = 1;

    // The status used after phone has been confirmed
    case PhoneConfirmed = 2;

    // That status used after login selected
    case Active = 3;

    // Baned user
    case Baned = 4;
}