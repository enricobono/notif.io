<?php

namespace App\Service\Notification;

use App\ValueObject\Message;

class SmsNotificationService implements NotificationServiceInterface
{
    public const CHANNEL = 'sms';

    public function __construct()
    {
        //Inject Twilio PHP SDK and Account SID/Token configuration from config and ENV
    }

    public function send(Message $message): void
    {
        // TODO: Implement send() method using Twilio
        $client = new \stdClass();
        $client->send();
    }
}
