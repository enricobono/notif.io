<?php

namespace App\ValueObject;

class EmailRecipient implements RecipientInterface
{
    public function __construct(private string $address)
    {
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }
}
