<?php

namespace App\Context\UsersManagement\Container\User\Event;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    public function onJWTCreated(JWTCreatedEvent $event): void
    {
        $user = $event->getUser();

        $payload = $event->getData();
        $payload['userId'] = $user->getId();

        $event->setData($payload);
    }
}