<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\Request\Contract;

use App\Context\UsersManagement\Container\Request\Model\RequestModel;
use App\Shared\Definition\BaseContract;

interface RequestRepositoryContract extends BaseContract
{

    public function createRequest(RequestModel $model);

    public function deleteRequest();

    public function getRequest();

    public function updateRequest();

    public function getRequestsList();
}