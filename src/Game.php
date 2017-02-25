<?php
namespace F3\Minesweeper;

class Game
{
    private $board;

    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    public function click(Point $point): void
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
                $this->click($n);
            }
        }
    }
}
