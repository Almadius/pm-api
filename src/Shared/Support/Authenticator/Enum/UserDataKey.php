<?php

declare(strict_types=1);

namespace App\Shared\Support\Authenticator\Enum;

enum UserDataKey: string
{
    case CacheKeyPersonalDataPrefix = 'user|personal_data|';
    case CacheKeyPreferencesPrefix = 'user|preferences|';
}