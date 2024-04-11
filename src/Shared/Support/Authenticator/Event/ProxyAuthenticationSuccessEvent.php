<?php

declare(strict_types=1);

namespace App\Shared\Support\Authenticator\Event;

use App\Shared\Parent\Model\UserParentModel;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method UserParentModel getUser()
 */
final class ProxyAuthenticationSuccessEvent extends AuthenticationSuccessEvent
{
    public function __construct(array $data, UserInterface $user)
    {
        parent::__construct($data, $user, new Response());
    }
}