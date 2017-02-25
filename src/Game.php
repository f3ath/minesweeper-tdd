<?php
namespace F3\Minesweeper;

class Game
{
    private $view;
    private $bomb_map;

    public function __construct(array $bomb_map)
    {
        $this->bomb_map = new BombMap($bomb_map);
        $this->view = array_fill(0, count($bomb_map), array_fill(0, count($bomb_map[0]), ' '));
    }

    public function getView(): array
    {
        return $this->view;
    }

    public function click(int $x, int $y): void
    {
        $this->view[$y][$x] = (string) $this->getBombsCountAround([$x, $y]);
    }

    private function getBombsCountAround(array $point): int
    {
        $count = 0;
        foreach ($this->getNeighbours($point) as $p) {
            if ($this->bomb_map->isBomb($p)) {
                $count++;
            }
        }
        return $count;
    }

    private function getNeighbours(array $p)
    {
        foreach ($this->getAdjacentCoordinates($p[0], $this->getWidth()) as $x) {
            foreach ($this->getAdjacentCoordinates($p[1], $this->getHeight()) as $y) {
                if ([$x, $y] != [$p]) {
                    yield [$x, $y];
                }
            }
        }
    }

    private function getAdjacentCoordinates(int $n, int $size): array
    {
        return range(max(0, $n - 1), min($n + 1, $size - 1));
    }

    private function getWidth(): int
    {
        return count($this->view[0]);
    }

    private function getHeight(): int
    {
        return count($this->view);
    }
}
