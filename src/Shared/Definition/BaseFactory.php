<?php

declare(strict_types=1);

namespace App\Shared\Definition;

use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

abstract class BaseFactory
{
    abstract protected function getDerivedModel(): string;

    /**
     * @throws ReflectionException
     */
    public final function build(array $data): BaseModel|BaseEntity
    {
        $derivedModelClass = $this->getDerivedModel();

        $derivedModel = new $derivedModelClass();

        $processedData = $this->processAndValidate($data);

        $properties = array_map(
            fn($property) => $property->getName(),
            (new ReflectionClass($derivedModel))->getProperties(
                ReflectionProperty::IS_PROTECTED
            )
        );

        foreach (
            [
                ...$this->defaultValues(),
                ...$processedData
            ] as $prop => $propValue
        ) {
            if (in_array($prop, $properties)) {
                $setterName = 'set' . $prop;

                $derivedModel->$setterName($propValue);
            }
        }

        return $derivedModel;
    }

    /**
     * @param array $data
     * @return array
     */
    protected function processAndValidate(array $data): array
    {
        return $data;
    }

    abstract protected function defaultValues(): array;
}