<?php

declare(strict_types=1);

namespace App\Shared\Support\Authenticator\Listener;

use App\Shared\Support\Authenticator\Enum\UserDataKey;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use App\Shared\Support\Authenticator\Event\ProxyAuthenticationSuccessEvent;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Contracts\Cache\CacheInterface;

final class JWTEventListener
{
    public function __construct(
        #[Autowire(service: CacheInterface::class)]
        private AdapterInterface $cacheAdapter,
    )
    {
    }

    public function onAuthenticationFailure(AuthenticationFailureEvent $event)
    {

    }

    #[AsEventListener(event: ProxyAuthenticationSuccessEvent::class)]
    public function __invoke(ProxyAuthenticationSuccessEvent $event)
    {
        $cachedUserData = $this->cacheAdapter->getItem(UserDataKey::CacheKeyPersonalDataPrefix->value . $event->getUser()->getId());

        $cachedUserData->set($event->getUser()->getPersonalData());

        $this->cacheAdapter->save($cachedUserData);

        $this->cacheAdapter->commit();
    }
}