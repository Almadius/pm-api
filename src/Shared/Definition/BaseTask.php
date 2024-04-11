<?php

declare(strict_types=1);

namespace App\Shared\Definition;

abstract class BaseTask
{
    abstract public function run(array $data);
}