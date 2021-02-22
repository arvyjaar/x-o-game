<?php

namespace App\Entity;

class Human implements PlayerInterface
{
    private const UNIT = 'x';

    public function getUnit(): string
    {
        return self::UNIT;
    }

    public function move(object $board) : array
    {
        return [];
    }
}
