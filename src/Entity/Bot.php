<?php

namespace App\Entity;

use App\Service\BoardStatusService;

class Bot implements PlayerInterface
{
    private const UNIT = 'o';

    public function getUnit(): string
    {
        return self::UNIT;
    }

    public function move(Board $board): array
    {
        $human = new Human();
        $players = [$this, $human];
        $emptyCells = $board->getEmptyCells();

        foreach ($players as $player) {
            foreach ($emptyCells as $cell) {
                $cell = $cell + ['unit' => $player->getUnit()];
                $board->setMove($cell);
                $boardStatusService = new BoardStatusService($board, $player);
                if ($boardStatusService->hasLine()) {
                    $cell['unit'] = $this->getUnit();
                    return $cell;
                }
                $board->unsetMove($cell);
            }
        }

        return $this->randomMove($board);
    }

    private function randomMove(Board $board): array
    {
        $emptyCells = $board->getEmptyCells();
        if (!$emptyCells) {
            return [];
        }
        $move = $emptyCells[array_rand($emptyCells)] + ['unit' => $this->getUnit()];

        return  $move;
    }
}
