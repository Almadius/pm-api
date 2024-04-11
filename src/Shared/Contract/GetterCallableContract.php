<?php

declare(strict_types=1);

namespace App\Shared\Contract;

interface GetterCallableContract
{
    public function gettersCallHandler(string $name): mixed;
}