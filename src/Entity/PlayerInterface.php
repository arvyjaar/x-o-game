<?php

namespace App\Entity;

interface PlayerInterface
{
    public function getUnit(): string;

    public function move(Board $board): array;
}
