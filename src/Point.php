<?php
namespace F3\Minesweeper;

class Point
{
    private $x;
    private $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public static function iterateRectangle(Rectangle $rect)
    {
        foreach (range(0, $rect->getWidth() - 1) as $x) {
            foreach (range(0, $rect->getHeight() - 1) as $y) {
                yield new Point($x, $y);
            }
        }
    }

    public function inArray(array $a)
    {
        return $a[$this->y][$this->x];
    }

    public function setInArray(array &$a, $value)
    {
        $a[$this->y][$this->x] = $value;
    }

    public function getNeighbours(int $width, int $height)
    {
        foreach ($this->getAdjacentCoordinates($this->x, $width) as $x) {
            foreach ($this->getAdjacentCoordinates($this->y, $height) as $y) {
                if ([$x, $y] != [$this->x, $this->y]) {
                    yield new Point($x, $y);
                }
            }
        }
    }

    private function getAdjacentCoordinates(int $n, int $size): array
    {
        return range(max(0, $n - 1), min($n + 1, $size - 1));
    }
}
