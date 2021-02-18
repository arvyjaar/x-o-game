<?php

namespace App\Entity;

class Bot implements PlayerInterface
{
    private const UNIT = 'o';

    public function getUnit(): string
    {
        return self::UNIT;
    }

    public function move(object $board): array
    {
        $emptyCells = $board->getEmptyCells();
        $move = $emptyCells[array_rand($emptyCells)] + ['unit' => self::UNIT];

        return  $move;
    }
}
