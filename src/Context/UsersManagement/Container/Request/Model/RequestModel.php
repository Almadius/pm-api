<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\Request\Model;

use App\Context\UsersManagement\Container\Request\Entity\RequestDoctrineEntity;
use App\Shared\Definition\BaseEntity;
use App\Shared\Definition\BaseModel;

/**
 * @property BaseEntity|RequestDoctrineEntity $entity
 */
final class RequestModel extends BaseModel
{
    public function __construct(array $data)
    {

    }
}