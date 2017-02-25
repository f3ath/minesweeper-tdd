<?php
namespace F3\Minesweeper;

class Board
{
    private const UNOPENED = ' ';
    private const BOMB = 'x';

    private $board;
    private $bomb_map;

    public function __construct(BombMap $bomb_map)
    {
        $this->bomb_map = $bomb_map;
        $this->board = array_fill(0, $bomb_map->getHeight(), array_fill(0, $bomb_map->getWidth(), self::UNOPENED));
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
        return $this->bomb_map->isBomb($point);
    }

    public function drawAllBombs()
    {
        foreach ($this->bomb_map->getAllBombPoints() as $bomb_point) {
            $this->drawBomb($bomb_point);
        }
    }

    public function getBombsCountAround(Point $point): int
    {
        $count = 0;
        foreach ($this->getNeighboursOf($point) as $p) {
            if ($this->bomb_map->isBomb($p)) {
                $count++;
            }
        }
        return $count;
    }

    public function getNeighboursOf(Point $point): \Generator
    {
        return $point->getNeighbours($this->bomb_map->getWidth(), $this->bomb_map->getHeight());
    }

    private function drawBomb(Point $point): void
    {
        $point->setInArray($this->board, self::BOMB);
    }
}
