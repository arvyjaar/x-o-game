<?php

namespace App\Entity;

class Bot implements PlayerInterface
{
    private const UNIT = 'o';

    public function getUnit(): string
    {
        return self::UNIT;
    }

    public function move(Board $board): array
    {
        $emptyCells = $board->getEmptyCells();
        if (!$emptyCells) {
            return [];
        }
        $move = $emptyCells[array_rand($emptyCells)] + ['unit' => self::UNIT];

        return  $move;
    }
}
