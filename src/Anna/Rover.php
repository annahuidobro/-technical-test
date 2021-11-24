<?php

namespace Anna;

use Exception;

class Rover
{
    const VALID_ORIENTATIONS = ['N', 'E', 'S', 'W'];

    private $orientation;

    public function __construct(string $orientation)
    {
        if (in_array($orientation, self::VALID_ORIENTATIONS) === false) {
            throw new Exception('Invalid orientation provided.');
        }

        $this->orientation = $orientation;
    }

    public function move(array $position, string $orientation): array
    {
        switch ($orientation) {
            case 'N':
                $position['x']++;
                break;
            case 'E':
                $position['y']++;
                break;
            case 'S':
                $position['x']--;
                break;
            case 'W':
                $position['y']--;
                break;
        }

        return $position;
    }

    public function turn(string $command, string $orientation): string
    {
        if ($command === 'L' && $orientation === 'N') {
            $this->orientation = 'W';
        }

        if ($command === 'L' && $orientation === 'E') {
            $this->orientation = 'N';
        }

        if ($command === 'L' && $orientation === 'S') {
            $this->orientation = 'E';
        }

        if ($command === 'L' && $orientation === 'W') {
            $this->orientation = 'S';
        }

        if ($command === 'R' && $orientation === 'N') {
            $this->orientation = 'E';
        }

        if ($command === 'R' && $orientation === 'E') {
            $this->orientation = 'S';
        }

        if ($command === 'R' && $orientation === 'S') {
            $this->orientation = 'W';
        }

        if ($command === 'R' && $orientation === 'W') {
            $this->orientation = 'N';
        }

        return $this->orientation;
    }

    public function orientation(): string
    {
        return $this->orientation;
    }
}
