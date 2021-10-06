<?php

namespace Unit\ValueObject;

use PHPUnit\Framework\TestCase;
use App\ValueObject\EmailRecipient;

class EmailRecipientTest extends TestCase
{
    public function testGetAddress(): void
    {
        $recipient = new EmailRecipient('test@example.com');

        $this->assertEquals('test@example.com', $recipient->getAddress());
    }
}
