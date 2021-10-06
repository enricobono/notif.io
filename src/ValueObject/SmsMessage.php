<?php

namespace App\ValueObject;

class SmsMessage implements MessageInterface
{

    //TODO test this class
    /**
     * @param string $body
     */
    public function __construct(private string $body)
    {

        //TODO Add some constraints
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }
}
