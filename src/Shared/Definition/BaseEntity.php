<?php

declare(strict_types=1);

namespace App\Shared\Definition;

use App\Shared\Contract\GetterCallableContract;
use App\Shared\Contract\SetterCallableContract;
use App\Shared\Exception\ScenarioException;
use App\Shared\Exception\SystemException;
use App\Shared\Trait\GetterCallableHandler;
use App\Shared\Trait\SetterCallableHandler;

abstract class BaseEntity implements GetterCallableContract, SetterCallableContract
{
    use GetterCallableHandler,
        SetterCallableHandler;

    /**
     * @throws SystemException
     * @throws ScenarioException
     */
    public function __call(string $name, array $arguments)
    {
        // For getters:
        if (lcfirst(substr($name, 0, 3)) === 'get') {
            return $this->gettersCallHandler($name);
        }

        // For setters:
        if (lcfirst(substr($name, 0, 3)) === 'set') {
            $this->settersCallHandler($name, $arguments[0]);

            return true;
        }

        throw new SystemException("Function $name not found");
    }
}