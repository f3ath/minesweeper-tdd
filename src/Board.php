<?php
namespace F3\Minesweeper;

class Board
{
    private const UNOPENED = ' ';
    private const BOMB = 'x';

    private $board;
    private $map;

    public function __construct(BombMap $map)
    {
        $this->map = $map;
        $this->board = array_fill(0, $map->getHeight(), array_fill(0, $map->getWidth(), self::UNOPENED));
    }

    public function toArray(): array
    {
        return $this->board;
    }

    public function drawNumber(Point $point, int $number): void
    {
        $point->setInArray($this->board, (string) $number);
    }

    public function isUnopened(Point $point): bool
    {
        return $point->inArray($this->board) == self::UNOPENED;
    }

    public function hasBomb(Point $point): bool
    {
        return $this->map->hasBomb($point);
    }

    public function drawAllBombs()
    {
        foreach ($this->map->getAllBombPoints() as $point) {
            $this->drawBomb($point);
        }
    }

    public function getBombsCountAround(Point $point): int
    {
        $count = 0;
        foreach ($this->getNeighbours($point) as $neighbour) {
            if ($this->map->hasBomb($neighbour)) {
                $count++;
            }
        }
        return $count;
    }

    public function getNeighbours(Point $point): \Generator
    {
        return $point->getNeighbours($this->map);
    }

    private function drawBomb(Point $point): void
    {
        $point->setInArray($this->board, self::BOMB);
    }
}
