<?php
namespace F3\Minesweeper;

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testCanCreateGame()
    {
        $game = new Game(2, 3);
        $this->assertView(
            [
                '  ',
                '  ',
                '  ',
            ],
            $game
        );
    }

    private function assertView(array $view, Game $game)
    {
        $this->assertEquals(
            array_map('str_split', $view),
            $game->getView()
        );
    }
}
