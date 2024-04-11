<?php

declare(strict_types=1);

namespace App\Context\Notifier\Container\Notification\Support\Notifier\Contract;

interface NotificationProviderContract
{
    public function sendSMS();

    public function sendPhoneCall();

    public function sendEmail();

    public function sendPushNotification();
}