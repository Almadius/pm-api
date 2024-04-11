<?php

declare(strict_types=1);

namespace App\Shared\Definition;

abstract class BaseAction
{
    abstract public function run(array $data): ActionResult;
}