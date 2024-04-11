<?php

declare(strict_types=1);

namespace App\Shared\Definition;

final class ActionResult
{
    public function __construct(
        public array $result
    )
    {
    }
}