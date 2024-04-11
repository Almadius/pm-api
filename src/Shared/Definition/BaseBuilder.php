<?php

declare(strict_types=1);

namespace App\Shared\Definition;

abstract class BaseBuilder
{
    abstract public function build(array $data);
}