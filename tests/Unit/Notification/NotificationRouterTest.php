<?php

namespace Unit\Notification;

use App\Service\Notification\EmailNotificationService;
use App\Service\Notification\NotificationRouter;
use App\Service\Notification\NotificationServiceFactory;
use App\Service\Notification\SmsNotificationService;
use App\ValueObject\Message;
use PHPUnit\Framework\TestCase;

class NotificationRouterTest extends TestCase
{

    public function testSendViaEmail()
    {
        $message = new Message(
            'test@example.com',
            '+393491234567',
            'title',
            'body',
            [SmsNotificationService::CHANNEL],
            []
        );

        $emailNotificationService = $this->prophesize(EmailNotificationService::class);
        $emailNotificationService->send($message)->shouldBeCalled();

        $notificationServiceFactory = $this->prophesize(NotificationServiceFactory::class);
        $notificationServiceFactory->getNotificationService('email')
            ->willReturn($emailNotificationService->reveal());
        $notificationRouter = new NotificationRouter($notificationServiceFactory->reveal());


        $notificationRouter->send($message);
    }

}
