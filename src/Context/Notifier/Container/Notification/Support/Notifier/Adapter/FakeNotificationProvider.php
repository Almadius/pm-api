<?php

namespace App\Context\Notifier\Container\Notification\Support\Notifier\Adapter;

use App\Context\Notifier\Container\Notification\Support\Notifier\Contract\NotificationProviderContract;

final class FakeNotificationProvider implements NotificationProviderContract
{

    public function sendSMS()
    {
    }

    public function sendPhoneCall()
    {
    }

    public function sendEmail()
    {
    }

    public function sendPushNotification()
    {
    }
}