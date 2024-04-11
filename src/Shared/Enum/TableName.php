<?php

namespace App\Shared\Enum;

enum TableName: string
{
    case Users = 'users';
    case Roles = 'roles';
    case UsersData = 'users_data';
    case Permissions = 'permissions';
}