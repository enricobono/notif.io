<?php

namespace Unit\ValueObject;

use App\ValueObject\EmailMessage;
use PHPUnit\Framework\TestCase;

class EmailMessageTest extends TestCase
{
    public function testGetProperties(): void
    {
        $message = new EmailMessage('title', 'body');

        $this->assertEquals('title', $message->getTitle());
        $this->assertEquals('body', $message->getBody());
    }
}
