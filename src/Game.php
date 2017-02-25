<?php
namespace F3\Minesweeper;

class Game
{
    private $view;
    private $bomb_map;

    public function __construct(array $bomb_map)
    {
        $this->bomb_map = new BombMap($bomb_map);
        $this->view = array_fill(0, $this->bomb_map->getHeight(), array_fill(0, $this->bomb_map->getWidth(), ' '));
    }

    public function getView(): array
    {
        return $this->view;
    }

    public function click(int $x, int $y): void
    {
        $this->view[$y][$x] = (string) $this->getBombsCountAround(new Point($x, $y));
    }

    private function getBombsCountAround(Point $point): int
    {
        $count = 0;
        foreach ($point->getNeighbours($this->bomb_map->getWidth(), $this->bomb_map->getHeight()) as $p) {
            if ($this->bomb_map->isBomb($p)) {
                $count++;
            }
        }
        return $count;
    }
}
