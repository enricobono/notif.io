<?php

namespace App\ValueObject;

class SmsRecipient implements RecipientInterface
{

    public function __construct(private string $phoneNumber)
    {
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }
}
