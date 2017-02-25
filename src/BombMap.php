<?php
namespace F3\Minesweeper;

class BombMap implements Rectangle
{
    public const BOMB = 'x';

    private $map;

    public function __construct(array $map)
    {
        $this->map = $map;
    }

    public function hasBomb(Point $point): bool
    {
        return $point->inArray($this->map) === self::BOMB;
    }

    public function getAllBombPoints()
    {
        foreach (Point::iterateRectangle($this) as $point) {
            if ($this->hasBomb($point)) {
                yield $point;
            }
        }
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
