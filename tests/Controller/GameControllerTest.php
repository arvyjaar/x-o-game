<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GameControllerTest extends WebTestCase
{
    public function testIndexResponseCode200(): void
    {
        $content = [
            ['x', '', 'x'],
            ['', '', 'o'],
            ['', 'x', ''],
        ];
        $client = static::createClient();
        $client->xmlHttpRequest('POST', '/game', [], [], [], json_encode(['board' => $content]));
        $this->assertResponseStatusCodeSame(200);
    }

    public function testIndexResponseContent(): void
    {
        $content = [
            ['x', 'x', 'x'],
            ['', '', 'o'],
            ['', 'x', ''],
        ];
        $client = static::createClient();
        $client->xmlHttpRequest('POST', '/game', [], [], [], json_encode(['board' => $content]));
        $this->assertResponseStatusCodeSame(200);
    }

    public function testIndexResponseContentWhenFullTable(): void
    {
        $content = [
            ['x', 'o', 'x'],
            ['o', 'x', 'o'],
            ['x', 'x', 'o'],
        ];
        $client = static::createClient();
        $client->xmlHttpRequest('POST', '/game', [], [], [], json_encode(['board' => $content]));
        $this->assertResponseStatusCodeSame(200);
    }
}
