<?php

declare(strict_types=1);

namespace App\Shared\Trait;

use App\Shared\Exception\ScenarioException;
use App\Shared\Exception\SystemException;

trait SetterCallableHandler
{
    /**
     * @throws SystemException
     * @throws ScenarioException
     */
    public function settersCallHandler(string $name, mixed $value): void
    {
        if (lcfirst(substr($name, 0, 3)) !== 'set') {
            throw new SystemException("The function $name should not be handled by settersCallHandler");
        }

        $assumedPropName = lcfirst(substr($name, 3));

        if(array_key_exists($assumedPropName, get_class_vars($this::class))) {
            $this->$assumedPropName = $value;

            return;
        }

        throw new ScenarioException("The setter for $name is not found");
    }
}