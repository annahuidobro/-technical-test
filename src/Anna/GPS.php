<?php

namespace Anna;

use Exception;

class GPS
{
    private $positions;

    public function __construct()
    {
        $this->positions = [];
    }

    public function savePosition(int $x, int $y): void
    {
        if ($x < 0 || $y < 0) {
            throw new Exception('Invalid initial position provided');
        }

        $this->positions[] = [
            'x' => $x,
            'y' => $y,
        ];
    }

    public function firstPosition(): array
    {
        return $this->positions[0];
    }

    public function lastPosition(): array
    {
        return end($this->positions);
    }

    public function positions(): array
    {
        return $this->positions;
    }
}
