<?php

namespace App\Tests\Entity;

use App\Entity\Board;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    private $board;
    private $content;

    protected function setUp(): void
    {
        $this->content = [
            ['x', '', 'x'],
            ['o', 'o', ''],
            ['', 'x', 'x'],
        ];
        $this->board = new Board($this->content);
    }

    public function testGetSize(): void
    {
        $expected = 3;
        $this->assertSame($expected, $this->board->getSize());
    }

    public function testGetContent(): void
    {
        $this->assertEquals($this->content, $this->board->getContent());
    }

    public function testGetEmptyCells(): void
    {
        $expected = [
            ['y' => 0, 'x' => 1],
            ['y' => 1, 'x' => 2],
            ['y' => 2, 'x' => 0],
        ];
        $emptyCells = $this->board->getEmptyCells();
        $this->assertEquals($expected, $emptyCells);
    }

    public function testSetMove(): void
    {
        $move = ['y' => 2, 'x' => 0, 'unit' => 'o'];
        $newBoard = $this->board->setMove($move);
        $newContent =
        $expected = new Board([
            ['x', '', 'x'],
            ['o', 'o', ''],
            ['o', 'x', 'x'],
        ]);
        $this->assertEquals($expected, $newBoard);
    }
}
