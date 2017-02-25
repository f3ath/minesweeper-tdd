<?php
namespace F3\Minesweeper;

class Game
{
    private $board;
    private $bomb_map;

    public function __construct(BombMap $bomb_map)
    {
        $this->bomb_map = $bomb_map;
        $this->board = new Board($bomb_map);
    }

    public function getBoard(): array
    {
        return $this->board->toArray();
    }

    public function click(int $x, int $y): void
    {
        $this->clickPoint(new Point($x, $y));
    }

    private function clickPoint(Point $point): void
    {
        if ($this->bomb_map->isBomb($point)) {
            foreach ($this->bomb_map->getAllBombPoints() as $bomb_point) {
                $this->board->drawBomb($bomb_point);
            }
            return;
        }
        $bombs = $this->getBombsCountAround($point);
        $this->board->drawNumber($point, $bombs);
        if ($bombs > 0) {
            return;
        }
        foreach ($this->getNeighboursOf($point) as $n) {
            if ($this->board->isUnopened($n)) {
                $this->clickPoint($n);
            }
        }
    }

    private function getBombsCountAround(Point $point): int
    {
        $count = 0;
        foreach ($this->getNeighboursOf($point) as $p) {
            if ($this->bomb_map->isBomb($p)) {
                $count++;
            }
        }
        return $count;
    }

    private function getNeighboursOf(Point $point): \Generator
    {
        return $point->getNeighbours($this->bomb_map->getWidth(), $this->bomb_map->getHeight());
    }
}
