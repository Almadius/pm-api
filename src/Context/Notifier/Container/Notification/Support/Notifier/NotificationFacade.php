<?php

declare(strict_types=1);

namespace App\Context\Notifier\Container\Notification\Support\Notifier;

use App\Context\Notifier\Container\Notification\Support\Notifier\Adapter\FakeNotificationProvider;
use App\Context\Notifier\Container\Notification\Support\Notifier\Contract\NotificationProviderContract;
use App\Context\Notifier\Container\Notification\Support\Notifier\Exception\NotificationProviderException;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

final class NotificationFacade
{
    public function __construct(
        #[Autowire(service: FakeNotificationProvider::class)]
        private NotificationProviderContract $provider
    )
    {
    }

    public function sendSMS(): void
    {
        try {
            $this->provider->sendSMS();
        } catch (NotificationProviderException $e) {

        }
    }

    public function sendPhoneCall(): void
    {
        try {
            $this->provider->sendPhoneCall();
        } catch (NotificationProviderException $e) {

        }
    }

    public function sendEmail(): void
    {
        try {
            $this->provider->sendEmail();
        } catch (NotificationProviderException $e) {

        }
    }

    public function sendPushNotification(): void
    {
        try {
            $this->provider->sendPushNotification();
        } catch (NotificationProviderException $e) {

        }
    }
}