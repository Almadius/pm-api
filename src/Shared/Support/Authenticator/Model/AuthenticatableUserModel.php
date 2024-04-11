<?php

namespace App\Shared\Support\Authenticator\Model;

use App\Shared\Parent\Model\UserParentModel;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;

abstract class AuthenticatableUserModel extends UserParentModel implements JWTUserInterface
{
    protected string $uuid;

    /**
     * We use phone number as a login, but we hide user's personal data, therefore
     * we put into payload user's uuid instead of login
     * @param $username
     * @param array $payload
     * @return JWTUserInterface
     */
    public static function createFromPayload($username, array $payload): JWTUserInterface
    {
        return new static();
    }

    public function getUserIdentifier(): string
    {
        return $this->getUuid();
    }

    public function eraseCredentials()
    {
        // Remove session here
    }

    public function getRoles(): array
    {
        return [];
    }
}