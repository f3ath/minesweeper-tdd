<?php
namespace F3\Minesweeper;

class Game
{
    private $width;
    private $height;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function getView()
    {
        return array_fill(0 ,$this->height, array_fill(0, $this->width, ' '));
    }
}
