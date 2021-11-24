<?php

namespace Anna;

use Exception;

class Map
{
    private $width;
    private $height;
    private $gps;

    public function __construct(int $width, int $height, GPS $gps)
    {
        if ($width < 0 || $height < 0) {
            throw new Exception('Invalid initial rectangle dimension provided');
        }

        $this->width  = $width;
        $this->height = $height;
        $this->gps    = $gps;
    }

    public function isInsideMap(): bool
    {
        $position = $this->gps->lastPosition();

        if ($position['x'] > $this->width || $position['y'] > $this->height) {
            return false;
        }

        return true;
    }

    public function width(): int
    {
        return $this->width;
    }

    public function height(): int
    {
        return $this->height;
    }
}
