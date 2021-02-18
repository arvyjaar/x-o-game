<?php

namespace App\Service;

use App\Entity\Board;
use App\Entity\PlayerInterface;

class PlayService
{
    public function play(Board $board, PlayerInterface $player, array $move = []): array
    {
        $boardStatusService = new BoardStatusService($board, $player);

        if ($boardStatusService->hasLine()) {
            return $winner = [
                'winner' => $player->getUnit(),
                'draw' => false,
                'botMove' => $move,
            ];
        }
        if (count($board->getEmptyCells()) == 0) {
            return [
                'winner' => false,
                'draw' => true,
                'botMove' => [],
            ];
        }

        return [
            'winner' => false,
            'draw' => false,
            'botMove' => $move
        ];
    }
}
