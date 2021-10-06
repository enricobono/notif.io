<?php

namespace App\Service\Notification;

use App\ValueObject\EmailMessage;
use App\ValueObject\EmailRecipient;
use App\ValueObject\MessageInterface;
use App\ValueObject\RecipientInterface;

class EmailNotificationService implements NotificationServiceInterface
{
    public const CHANNEL = 'email';

    public function __construct()
    {
    }

    public function send(RecipientInterface $recipient, MessageInterface $message): void
    {
        $this->sendEmail($recipient, $message);
    }

    private function sendEmail(EmailRecipient $recipient, EmailMessage $message)
    {
        // TODO: Implement send() method
        $client = new \stdClass();
        $client->send();
    }
}
