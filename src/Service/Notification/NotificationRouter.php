<?php

namespace App\Service\Notification;

use App\ValueObject\Message;

class NotificationRouter
{

    private NotificationServiceFactory $notificationServiceFactory;

    /**
     * @param NotificationServiceFactory $notificationServiceFactory
     */
    public function __construct(NotificationServiceFactory $notificationServiceFactory)
    {
        $this->notificationServiceFactory = $notificationServiceFactory;
    }

    /**
     * @param Message $message
     *
     * @return void
     */
    public function send(Message $message)
    {
        $successfulChannels = $this->sendMessageToPrimaryChannels($message);

        if (count($successfulChannels) < count($message->getChannels())) {
            $this->sendMessageWithFailOverChannels($message, $successfulChannels);
        }
    }

    /**
     * @param Message $message
     *
     * @return array
     */
    private function sendMessageToPrimaryChannels(Message $message): array
    {
        $successfulChannels = [];
        foreach ($message->getChannels() as $channel) {
            try {
                $notificationService = $this->notificationServiceFactory->getNotificationService($channel);
                $notificationService->send($message);

                $successfulChannels[] = $channel;
            } catch (\Exception) {
            }
        }

        return $successfulChannels;
    }

    /**
     * @param Message $message
     * @param array   $successfulChannels
     *
     * @return void
     */
    private function sendMessageWithFailOverChannels(Message $message, array $successfulChannels): void
    {
        foreach ($message->getFailOverChannels() as $channel) {
            try {
                if (in_array($channel, $successfulChannels)) {
                    //Already sent to this channel, don't send it again
                    $notificationService = $this->notificationServiceFactory->getNotificationService($channel);
                    $notificationService->send($message);
                }
            } catch (\Exception) {
                throw new \DomainException(
                    sprintf(
                        'Cannot send message for user "%s" via channel "%s"',
                        $message->getEmailAddress(),
                        $channel
                    )
                );
            }
        }
    }
}
