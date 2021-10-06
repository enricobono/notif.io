<?php

namespace Unit\Notification;

use App\Service\Notification\EmailNotificationService;
use App\Service\Notification\NotificationRouter;
use App\Service\Notification\NotificationServiceFactory;
use App\Service\Notification\SmsNotificationService;
use App\ValueObject\Message;
use PHPUnit\Framework\TestCase;

class NotificationServiceFactoryTest extends TestCase
{

    private NotificationServiceFactory $service;

    public function setUp(): void
    {
        $this->service = new NotificationServiceFactory();

        parent::setUp();
    }

    /**
     * @dataProvider getNotificationServiceDataProvider
     */
    public function testGetNotificationService($class, $channel)
    {
        $this->assertInstanceOf($class, $this->service->getNotificationService($channel));
    }

    public function getNotificationServiceDataProvider()
    {
        return [
            [EmailNotificationService::class, 'email'],
            [SmsNotificationService::class, 'sms'],
        ];
    }

    public function testCannotCreateServiceWhenChannelIsUnknown()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Notification channel not found');

        $this->service->getNotificationService('unknown-service');
    }
}
