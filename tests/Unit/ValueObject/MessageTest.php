<?php

namespace Unit\ValueObject;

use App\Service\Notification\EmailNotificationService;
use App\Service\Notification\SmsNotificationService;
use App\ValueObject\Message;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{

    public function testCreateMessage(): void
    {
        $message = new Message(
            'test@example.com',
            '+393491234567',
            'title',
            'body',
            [SmsNotificationService::CHANNEL],
            [EmailNotificationService::CHANNEL]
        );

        $this->assertEquals('test@example.com', $message->getEmailAddress());
        $this->assertEquals('+393491234567', $message->getPhoneNumber());
        $this->assertEquals('title', $message->getTitle());
        $this->assertEquals('body', $message->getBody());
        $this->assertEquals(['sms'], $message->getChannels());
        $this->assertEquals(['email'], $message->getFailOverChannels());
    }

    public function testCannotCreateMessageWithInvalidEmailAddress(): void
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Email address is not valid');
        new Message(
            'invalid email address',
            '+393491234567',
            'title',
            'body',
            [SmsNotificationService::CHANNEL],
            [EmailNotificationService::CHANNEL]
        );
    }

    public function testCannotCreateMessageWithInvalidPhoneNumber(): void
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Phone number is not valid');
        new Message(
            'test@example.com',
            '111',
            'title',
            'body',
            [SmsNotificationService::CHANNEL],
            [EmailNotificationService::CHANNEL]
        );
    }

    public function testCannotCreateMessageWithShortTitles(): void
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Provided title should be longer than 3 chars');
        new Message(
            'test@example.com',
            '+393491234567',
            'a',
            'body',
            [SmsNotificationService::CHANNEL],
            [EmailNotificationService::CHANNEL]
        );
    }

    public function testCannotCreateMessageWithShortBodies(): void
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Provided body should be longer than 3 chars');
        new Message(
            'test@example.com',
            '+393491234567',
            'title',
            'a',
            [SmsNotificationService::CHANNEL],
            [EmailNotificationService::CHANNEL]
        );
    }

    public function testCannotCreateMessageWithoutChannels(): void
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('At least 1 channel is required');
        new Message(
            'test@example.com',
            '+393491234567',
            'title',
            'body',
            [],
            [EmailNotificationService::CHANNEL]
        );
    }

    public function testCannotCreateMessageWithNotExistingChannels(): void
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Unsupported channel');
        new Message(
            'test@example.com',
            '+393491234567',
            'title',
            'body',
            ['telegram'],
            [EmailNotificationService::CHANNEL]
        );
    }

    public function testCannotCreateMessageWithNotExistingFailOverChannels(): void
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Unsupported fail-over channel');
        new Message(
            'test@example.com',
            '+393491234567',
            'title',
            'body',
            [EmailNotificationService::CHANNEL],
            ['telegram']
        );
    }
}
