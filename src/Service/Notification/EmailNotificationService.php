<?php

namespace App\Service\Notification;

use App\ValueObject\Message;

class EmailNotificationService implements NotificationServiceInterface
{
    public const CHANNEL = 'email';

    public function __construct()
    {
        //Inject AWS PHP SDK and API KEYs configuration from config and ENV
    }

    public function send(Message $message): void
    {
        // TODO: Implement send() method using SES
        $client = new \stdClass();
        $client->send();
    }
}
