<?php
namespace F3\Minesweeper;

class Game
{
    private $board;

    public function __construct(Board $board)
    {
        $this->board = $board;
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
        if ($this->board->hasBomb($point)) {
            $this->board->drawAllBombs();
            return;
        }
        $bombs = $this->board->getBombsCountAround($point);
        $this->board->drawNumber($point, $bombs);
        if ($bombs > 0) {
            return;
        }
        foreach ($this->board->getNeighboursOf($point) as $n) {
            if ($this->board->isUnopened($n)) {
                $this->clickPoint($n);
            }
        }
    }
}
