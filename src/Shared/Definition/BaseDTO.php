<?php

declare(strict_types=1);

namespace App\Shared\Definition;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Exception\ValidatorException;

abstract class BaseDTO
{
    public function validate(Request $request): void
    {
        $this->validateHeaders($request->headers->all());

        $this->validateAcceptableFormat($request->getContentTypeFormat());

        $this->validateData($request->toArray());
    }

    protected function validateAcceptableFormat(string $contentType): void
    {
        if ($contentType !== 'json') {
            throw new ValidatorException('The content type must be application/json', 422);
        }
    }

    protected function validateHeaders(array $headers): void
    {

    }

    protected function validateData(array $data): void
    {

    }
}