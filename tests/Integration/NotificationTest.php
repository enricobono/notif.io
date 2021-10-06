<?php

namespace Integration;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Service\Notification\EmailNotificationService;
use App\Service\Notification\SmsNotificationService;

class NotificationTest extends ApiTestCase
{

    public function testPostValidMessage(): void
    {
        $response = static::createClient()->request(
            'POST',
            '/notification',
            [
                'query' =>
                    [
                        'email_address'      => 'test@example.com',
                        'phone_number'       => '+393491234567',
                        'title'              => 'title',
                        'body'               => 'body',
                        'channels'           => [SmsNotificationService::CHANNEL],
                        'fail_over_channels' => [EmailNotificationService::CHANNEL],
                    ]
            ]
        );

        $this->assertEquals(201, $response->getStatusCode());
    }


    public function testErrorOnInvalidEmailAddress(): void
    {
        $response = static::createClient()->request(
            'POST',
            '/notification',
            [
                'query' =>
                    [
                        'email_address'      => 'invalid',
                        'phone_number'       => '+393491234567',
                        'title'              => 'title',
                        'body'               => 'body',
                        'channels'           => [SmsNotificationService::CHANNEL],
                        'fail_over_channels' => [EmailNotificationService::CHANNEL],
                    ]
            ]
        );

        $this->assertEquals(400, $response->getStatusCode());
    }
}
