<?php

namespace App\Service\Notification;

class NotificationServiceFactory
{

    /**
     * @param string $channel
     *
     * @return NotificationServiceInterface
     */
    public function getNotificationService(string $channel): NotificationServiceInterface
    {
        switch ($channel) {
            case SmsNotificationService::CHANNEL:
                return new SmsNotificationService();
                break;

            case EmailNotificationService::CHANNEL:
                return new EmailNotificationService();
                break;
        }

        throw new \DomainException('Notification channel not found');
    }
}
