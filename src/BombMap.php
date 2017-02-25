<?php
namespace F3\Minesweeper;

class BombMap
{
    private $map;

    public function __construct(array $map)
    {
        $this->map = $map;
    }

    public function isBomb($p): bool
    {
        return $this->map[$p[1]][$p[0]] == 'x';
    }
}
