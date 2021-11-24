<?php

namespace Anna;

use Exception;

class AI
{
    const VALID_COMMANDS = ['A', 'L', 'R'];

    private $commands;

    public function createCommands(array $commands): void
    {
        foreach ($commands as $command) {
            if (in_array($command, self::VALID_COMMANDS) === false) {
                throw new Exception('Invalid commands provided.');
            }
        }

        $this->commands = $commands;
    }

    public function executeCommands(Rover $rover, GPS $gps, Map $map): bool
    {
        foreach ($this->commands as $command) {
            if ($command === 'A') {
                $position = $rover->move($gps->lastPosition(), $rover->orientation());

                $gps->savePosition($position['x'], $position['y']);

                if ($map->isInsideMap() === false) {
                    return false;
                }
            } else {
                $rover->turn($command, $rover->orientation());
            }
        }

        return true;
    }

    public function commands(): array
    {
        return $this->commands;
    }
}
