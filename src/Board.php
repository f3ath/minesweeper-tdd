<?php
namespace F3\Minesweeper;

class Board
{
    private const UNOPENED = ' ';
    private const BOMB = 'x';

    private $board;

    public function __construct(Rectangle $rect)
    {
        $this->board = array_fill(0, $rect->getHeight(), array_fill(0, $rect->getWidth(), self::UNOPENED));
    }

    public function toArray(): array
    {
        return $this->board;
    }

    public function drawNumber(Point $point, int $number): void
    {
        $point->setInArray($this->board, (string) $number);
    }

    public function drawBomb(Point $point): void
    {
        $point->setInArray($this->board, self::BOMB);
    }

    public function isUnopened(Point $point): bool
    {
        return $point->inArray($this->board) == self::UNOPENED;
    }
}
