<?php

declare(strict_types=1);

namespace App\Shared\Trait;

use App\Shared\Exception\ScenarioException;
use App\Shared\Exception\SystemException;

trait GetterCallableHandler
{
    /**
     * @throws SystemException
     * @throws ScenarioException
     */
    public function gettersCallHandler(string $name): mixed
    {
        if (lcfirst(substr($name, 0, 3)) !== 'get') {
            throw new SystemException("The function $name should not be handled by gettersCallHandler");
        }

        $assumedPropName = lcfirst(substr($name, 3));

        if(array_key_exists($assumedPropName, get_class_vars($this::class))) {
            if(isset($this->{$assumedPropName})){
                return $this->{$assumedPropName};
            }

            return null;
        }

        throw new ScenarioException("The getter for $name is not found");
    }
}