<?php

namespace App\Service\Notification;

use App\ValueObject\EmailMessage;
use App\ValueObject\EmailRecipient;
use App\ValueObject\MessageInterface;
use App\ValueObject\RecipientInterface;

class SmsNotificationService implements NotificationServiceInterface
{
    public const CHANNEL = 'sms';

    public function __construct()
    {
    }

    public function send(RecipientInterface $recipient, MessageInterface $message): void
    {
        $this->sendSms($recipient, $message);
    }

    private function sendSms(SmsRecipient $recipient, SmsMessage $message)
    {
        // TODO: Implement sendSms() method.
        $client = new \stdClass();
        $client->send();
    }
}
