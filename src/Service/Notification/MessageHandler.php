<?php

namespace App\Service\Notification;

use App\ValueObject\Message;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class MessageHandler implements MessageHandlerInterface
{


    public function __invoke(Message $message)
    {

        dump('invoked message for ' . $message->getEmailAddress());
        //TODO Send the message via the Notification Router

    }
}
