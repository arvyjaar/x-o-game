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

    public function testIndexResponseContentWhenEmptyTable(): void
    {
        $content = [
            ['', '', ''],
            ['', '', ''],
            ['', '', ''],
        ];
        $client = static::createClient();
        $client->xmlHttpRequest('POST', '/game', [], [], [], json_encode(['board' => $content]));
        $this->assertResponseStatusCodeSame(200);
    }

    public function testValidationNothingGiven(): void
    {
        $content = null;
        $client = static::createClient();
        $client->xmlHttpRequest('POST', '/game', [], [], [], json_encode($content));
        $this->assertResponseStatusCodeSame(400);
    }

    public function testValidationStringGiven(): void
    {
        $content = ['board' => 'Some string'];
        $client = static::createClient();
        $client->xmlHttpRequest('POST', '/game', [], [], [], json_encode($content));
        $this->assertResponseStatusCodeSame(400);
    }
    
    public function testValidationLessThan3Rows(): void
    {
        $client = static::createClient();
        $content = [
            ['', 'x', ''],
            ['', '', 'o'],
        ];
        $client->xmlHttpRequest('POST', '/game', [], [], [], json_encode(['board' => $content]));
        $this->assertResponseStatusCodeSame(400);
    }

    public function testValidationMoreThan3Rows(): void
    {
        $client = static::createClient();
        $content = [
            ['', 'x', ''],
            ['', '', 'x'],
            ['', '', 'o'],
            ['x', 'o', ''],
        ];
        $client->xmlHttpRequest('POST', '/game', [], [], [], json_encode(['board' => $content]));
        $this->assertResponseStatusCodeSame(400);
    }

    public function testValidationLessThan3ItemsInRowSameLength(): void
    {
        $client = static::createClient();
        $content = [
            ['', 'x'],
            ['', '',],
            ['', '',],
        ];
        $client->xmlHttpRequest('POST', '/game', [], [], [], json_encode(['board' => $content]));
        $this->assertResponseStatusCodeSame(400);
    }

    public function testValidationLessThan3ItemsInRowDifferentLength(): void
    {
        $client = static::createClient();
        $content = [
            ['', 'x'],
            ['', '', 'o'],
            ['', '',],
        ];
        $client->xmlHttpRequest('POST', '/game', [], [], [], json_encode(['board' => $content]));
        $this->assertResponseStatusCodeSame(400);
    }

    public function testValidationMoreThan3ItemsInRow(): void
    {
        $client = static::createClient();
        $content = [
            ['', 'x', ''],
            ['', '', 'x', 'o'],
            ['', '', 'o'],
        ];
        $client->xmlHttpRequest('POST', '/game', [], [], [], json_encode(['board' => $content]));
        $this->assertResponseStatusCodeSame(400);
    }

    public function testValidationInvalidUnit(): void
    {
        $client = static::createClient();
        $content = [
            ['', 'x', ''],
            ['', 'Y', ''],
            ['', '', 'o'],
        ];
        $client->xmlHttpRequest('POST', '/game', [], [], [], json_encode(['board' => $content]));
        $this->assertResponseStatusCodeSame(400);
    }
}
