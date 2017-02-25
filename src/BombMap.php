<?php
namespace F3\Minesweeper;

class BombMap
{
    private $map;

    public function __construct(array $map)
    {
        $this->map = $map;
    }

    public function isBomb(Point $point): bool
    {
        return $point->inArray($this->map) === 'x';
    }

    public function getHeight(): int
    {
        return count($this->map);
    }

    public function getWidth(): int
    {
        return count($this->map[0]);
    }
}
