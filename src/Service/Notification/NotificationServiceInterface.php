<?php

namespace App\Service\Notification;

use App\ValueObject\MessageInterface;
use App\ValueObject\RecipientInterface;

interface NotificationServiceInterface
{

    /**
     * @param RecipientInterface $recipient
     * @param MessageInterface   $message
     *
     * @return void
     */
    public function send(RecipientInterface $recipient, MessageInterface $message): void;
}
