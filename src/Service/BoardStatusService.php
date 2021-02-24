<?php

namespace App\Service;

use App\Entity\Board;
use App\Entity\PlayerInterface;

class BoardStatusService
{
    private Board $board;
    private PlayerInterface $player;

    public function __construct(Board $board, PlayerInterface $player)
    {
        $this->board = $board;
        $this->player = $player;
    }

    public function hasLine(): bool
    {
        return ($this->checkRowsColumns() || $this->checkDiagonal()) ?: false;
    }

    private function checkRowsColumns(): bool
    {
        $reversedContent = [$this->board->getContent(), array_map(null, ...($this->board->getContent()))];
        foreach ($reversedContent as $content) {
            $markedCount = null;
            foreach ($content as $row) {
                $markedCount = count(array_keys($row, $this->player->getUnit()));
                if ($markedCount === $this->board->getSize()) {
                    return true;
                }
            }
        }

        return false;
    }

    private function checkDiagonal(): bool
    {
        $reversedContent = [$this->board->getContent(), array_reverse($this->board->getContent())];
        foreach ($reversedContent as $content) {
            $marksCount = null;
            foreach ($content as $y => $row) {
                foreach ($row as $x => $value) {
                    if ($y === $x) {
                        ($content[$y][$x] === $this->player->getUnit()) ? $marksCount += 1 : false;
                    }
                }
            }
            if ($marksCount === $this->board->getSize()) {
                return true;
            }
        }

        return false;
    }
}
