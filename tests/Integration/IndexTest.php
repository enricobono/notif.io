<?php

namespace Integration;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class IndexTest extends ApiTestCase
{
    public function testSomething(): void
    {
        $response = static::createClient()->request('GET', '/');

        $this->assertEquals(404, $response->getStatusCode());
    }
}
