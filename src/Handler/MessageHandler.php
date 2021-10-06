<?php

namespace App\Handler;

use App\Service\Notification\NotificationRouter;
use App\ValueObject\Message;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class MessageHandler implements MessageHandlerInterface
{

    private NotificationRouter $notificationRouter;

    /**
     * @param NotificationRouter $notificationRouter
     */
    public function __construct(NotificationRouter $notificationRouter)
    {
        $this->notificationRouter = $notificationRouter;
    }

    public function __invoke(Message $message)
    {
        $this->notificationRouter->send($message);
    }
}
