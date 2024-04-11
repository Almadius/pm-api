<?php

declare(strict_types=1);

namespace App\Shared\Contract;

interface SetterCallableContract
{
    public function settersCallHandler(string $name, mixed $value): void;
}