<?php

namespace App\Tests\Entity;

use App\Entity\Human;
use App\Entity\Board;
use PHPUnit\Framework\TestCase;

class HumanTest extends TestCase
{
    private $human;

    protected function setUp(): void
    {
        $this->human = new Human();
    }

    public function testGetUnit(): void
    {
        $expected = 'x';
        $this->assertSame($expected, $this->human->getUnit());
    }

    public function testMove(): void
    {
        $content = [
            ['x', 'o', 'x'],
            ['o', 'o', ''],
            ['x', 'x', 'x'],
        ];
        $board = new Board($content);
        $expected = [];
        $this->assertEquals($expected, $this->human->move($board));
    }
}
