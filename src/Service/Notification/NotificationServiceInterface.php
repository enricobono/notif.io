<?php

namespace App\Service\Notification;

use App\ValueObject\Message;

interface NotificationServiceInterface
{

    /**
     * @param Message $message
     *
     * @return void
     */
    public function send(Message $message): void;
}
