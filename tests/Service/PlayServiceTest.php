<?php

namespace App\Tests\Service;

use App\Entity\Bot;
use App\Entity\Board;
use App\Entity\Human;
use App\Service\PlayService;
use PHPUnit\Framework\TestCase;

class PlayServiceTest extends TestCase
{
    private $board;
    private $playService;
    private $player;

    protected function setUp(): void
    {
        $this->player = new Bot();
        $this->playService = new PlayService();
    }

    public function testPlayHasWinner(): void
    {
        $content = [
            ['x', '', 'x'],
            ['o', 'o', 'o'],
            ['', 'x', ''],
        ];
        $board = new Board($content);
        $move = ['y' => 1, 'x' => 0, 'unit' => 'o'];
        $expected = [
            'winner' => 'o',
            'draw' => false,
            'botMove' => $move,
        ];
        $test = $this->playService->play($board, $this->player, $move);
        $this->assertEquals($expected, $test);
    }

    public function testPlayHasWinnerHuman(): void
    {
        $content = [
            ['x', 'x', 'x'],
            ['o', '', 'o'],
            ['', '', ''],
        ];
        $board = new Board($content);
        $human = new Human();
        $expected = [
            'winner' => 'x',
            'draw' => false,
            'botMove' => [],
        ];
        $test = $this->playService->play($board, $human);
        $this->assertEquals($expected, $test);
    }

    public function testPlayIsDraw(): void
    {
        $content = [
            ['x', 'x', 'o'],
            ['o', 'o', 'x'],
            ['x', 'x', 'o'],
        ];
        $board = new Board($content);
        $expected = [
            'winner' => false,
            'draw' => true,
            'botMove' => [],
        ];
        $test = $this->playService->play($board, $this->player);
        $this->assertEquals($expected, $test);
    }

    public function testPlayBotMoves(): void
    {
        $content = [
            ['x', '', 'o'],
            ['', 'o', 'x'],
            ['x', 'o', ''],
        ];
        $board = new Board($content);
        $move = ['y' => 0, '' => 2, 'unit' => 'o'];
        $expected = [
            'winner' => false,
            'draw' => false,
            'botMove' => $move,
        ];
        $test = $this->playService->play($board, $this->player, $move);
        $this->assertEquals($expected, $test);
    }
}
