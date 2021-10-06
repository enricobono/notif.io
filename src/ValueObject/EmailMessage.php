<?php

namespace App\ValueObject;

class EmailMessage implements MessageInterface
{

    /**
     * @param string $title
     * @param string $body
     */
    public function __construct(private string $title, private string $body)
    {
        //TODO add some constraints
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
}
