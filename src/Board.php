<?php
namespace F3\Minesweeper;

class Board
{
    private $board;

    public function __construct(Rectangle $rect)
    {
        $this->board = array_fill(0, $rect->getHeight(), array_fill(0, $rect->getWidth(), ' '));
    }

    public function toArray(): array
    {
        return $this->board;
    }

    public function drawNumber(Point $point, int $value)
    {
        $point->setInArray($this->board, (string) $value);
    }

    public function drawBomb(Point $point)
    {
        $point->setInArray($this->board, 'x');
    }

    public function isOpen(Point $point): bool
    {
        return $point->inArray($this->board) == ' ';
    }
}
