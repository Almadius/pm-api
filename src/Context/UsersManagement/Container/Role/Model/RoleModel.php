<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\Role\Model;

use App\Shared\Definition\BaseModel;

/**
 * @method int getId();
 * @method string getName();
 * @method string getDescription();
 * @method void setId(int $id);
 * @method void setName(string $name);
 * @method void setDescription(string $description);
 */
final class RoleModel extends BaseModel
{
    protected int $id;

    protected string $name;

    protected ?string $description;
}