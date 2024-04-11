<?php

declare(strict_types=1);

namespace App\Context\UsersManagement\Container\User\DTO;

use App\Shared\Definition\BaseDTO;
use Symfony\Component\Validator\Constraints;

final class LoginWithPasswordDTO extends BaseDTO
{
    public function __construct(
        #[Constraints\NotBlank(
            message: 'Phone is a required parameter'
        )]
        #[Constraints\Regex(
            pattern: '/^[\+][0-9]{11}$/',
            message: 'Phone is not in the correct format',
            match: true
        )]
        public readonly string $phone,

        #[Constraints\NotBlank(
            message: 'Password is a required parameter'
        )]
        public readonly string $password,
    ) {
    }
}