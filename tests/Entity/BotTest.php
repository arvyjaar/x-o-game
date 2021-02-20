<?php

namespace App\Tests\Entity;

use App\Entity\Bot;
use App\Entity\Board;
use PHPUnit\Framework\TestCase;

class BotTest extends TestCase
{
    private $bot;

    protected function setUp(): void
    {
        $this->bot = new Bot();
    }

    public function testGetUnit(): void
    {
        $expected = 'o';
        $this->assertSame($expected, $this->bot->getUnit());
    }

    public function testMoveFromOneChoice(): void
    {
        $content = [
            ['x', 'o', 'x'],
            ['o', 'o', ''],
            ['x', 'x', 'x'],
        ];
        $board = new Board($content);
        $expected = [
            'y' => 1,
            'x' => 2,
            'unit' => 'o'
        ];
        $this->assertEquals($expected, $this->bot->move($board));
    }

    public function testMoveFromMultipleChoice(): void
    {
        $content = [
            ['x', 'o', 'o'],
            ['o', '', 'x'],
            ['', 'o', 'o'],
        ];
        $board = new Board($content);
        $possibleVariants = [
            [
                'y' => 1,
                'x' => 1,
                'unit' => 'o'
            ],
            [
                'y' => 2,
                'x' => 0,
                'unit' => 'o'
            ]
        ];
        $this->assertTrue(in_array($this->bot->move($board), $possibleVariants));
    }

    public function testMoveWhenNoEmptyCells(): void
    {
        $content = [
            ['x', 'o', 'o'],
            ['o', 'x', 'x'],
            ['x', 'o', 'o'],
        ];
        $board = new Board($content);
        $expected = [];
        $this->assertEquals($expected, $this->bot->move($board));
    }
}
