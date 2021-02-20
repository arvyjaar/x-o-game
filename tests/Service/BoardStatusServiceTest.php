<?php

namespace App\Tests\Service;

use App\Entity\Bot;
use App\Entity\Board;
use App\Entity\Human;
use PHPUnit\Framework\TestCase;
use App\Service\BoardStatusService;

class BoardStatusServiceTest extends TestCase
{
    private $player;

    protected function setUp(): void
    {
        $this->player = new Bot();
    }

    public function testHasLineVerticalTrue(): void
    {
        $content = [
            ['x', 'o', 'x'],
            ['', 'o', 'o'],
            ['o', 'o', 'x'],
        ];
        $board = new Board($content);
        $boardStatusService = new BoardStatusService($board, $this->player);
        $this->assertTrue($boardStatusService->hasLine());
    }

    public function testHasLineHorizontalTrue(): void
    {
        $content = [
            ['x', '', 'x'],
            ['o', 'o', 'o'],
            ['o', 'o', 'x'],
        ];
        $board = new Board($content);
        $boardStatusService = new BoardStatusService($board, $this->player);
        $this->assertTrue($boardStatusService->hasLine());
    }

    public function testHasLineDiagonalTrue(): void
    {
        $content = [
            ['x', '', 'o'],
            ['', 'o', 'o'],
            ['o', 'x', 'x'],
        ];
        $board = new Board($content);
        $boardStatusService = new BoardStatusService($board, $this->player);
        $this->assertTrue($boardStatusService->hasLine());
    }

    public function testHasLineBackwardDiagonalTrue(): void
    {
        $content = [
            ['o', '', 'x'],
            ['', 'o', 'o'],
            ['o', 'x', 'o'],
        ];
        $board = new Board($content);
        $boardStatusService = new BoardStatusService($board, $this->player);
        $this->assertTrue($boardStatusService->hasLine());
    }

    public function testHasLineFalse(): void
    {
        $content = [
            ['x', 'o', 'x'],
            ['o', 'x', 'o'],
            ['x', 'x', 'x'],
        ];
        $board = new Board($content);
        $boardStatusService = new BoardStatusService($board, $this->player);
        $this->assertFalse($boardStatusService->hasLine());
    }

    public function testHasLineInEmptyBoardFalse(): void
    {
        $content = [
            ['', '', ''],
            ['', '', ''],
            ['', '', ''],
        ];
        $board = new Board($content);
        $boardStatusService = new BoardStatusService($board, $this->player);
        $this->assertFalse($boardStatusService->hasLine());
    }

    public function testHumanHasLineTrue(): void
    {
        $human = new Human();
        $content = [
            ['o', '', 'x'],
            ['', 'o', 'o'],
            ['x', 'x', 'x'],
        ];
        $board = new Board($content);
        $boardStatusService = new BoardStatusService($board, $human);
        $this->assertTrue($boardStatusService->hasLine());
    }

    public function testHumanHasLineFalse(): void
    {
        $human = new Human();
        $content = [
            ['o', 'o', 'o'],
            ['x', 'o', 'o'],
            ['x', '', 'x'],
        ];
        $board = new Board($content);
        $boardStatusService = new BoardStatusService($board, $human);
        $this->assertFalse($boardStatusService->hasLine());
    }
}
