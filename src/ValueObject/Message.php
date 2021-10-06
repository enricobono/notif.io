<?php

namespace App\ValueObject;

use App\Service\Notification\EmailNotificationService;
use App\Service\Notification\SmsNotificationService;

class Message
{

    private string $emailAddress;

    private string $phoneNumber;

    private string $title;

    private string $body;

    private array $channels;

    private array $failOverChannels;

    /**
     * @param string $emailAddress
     * @param string $phoneNumber
     * @param string $title
     * @param string $body
     * @param array  $channels
     * @param array  $failOverChannels
     */
    public function __construct(
        string $emailAddress,
        string $phoneNumber,
        string $title,
        string $body,
        array $channels,
        array $failOverChannels = []
    ) {
        if (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            throw new \DomainException('Email address is not valid');
        }

        if (!preg_match('/^([+]\d{2})?\d{10}/', $phoneNumber)) {
            throw new \DomainException('Phone number is not valid');
        }

        if (strlen($title) <= 3) {
            throw new \DomainException('Provided title should be longer than 3 chars');
        }

        if (strlen($body) <= 3) {
            throw new \DomainException('Provided body should be longer than 3 chars');
        }

        if (empty($channels)) {
            throw new \DomainException('At least 1 channel is required');
        }

        foreach ($channels as $channel) {
            if (!in_array($channel, [SmsNotificationService::CHANNEL, EmailNotificationService::CHANNEL])) {
                throw new \DomainException('Unsupported channel');
            }
        }

        foreach ($failOverChannels as $channel) {
            if (!in_array($channel, [SmsNotificationService::CHANNEL, EmailNotificationService::CHANNEL])) {
                throw new \DomainException('Unsupported fail-over channel');
            }
        }

        $this->emailAddress     = $emailAddress;
        $this->phoneNumber      = $phoneNumber;
        $this->title            = $title;
        $this->body             = $body;
        $this->channels         = $channels;
        $this->failOverChannels = $failOverChannels;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return array
     */
    public function getChannels(): array
    {
        return $this->channels;
    }

    /**
     * @return array
     */
    public function getFailOverChannels(): array
    {
        return $this->failOverChannels;
    }
}
