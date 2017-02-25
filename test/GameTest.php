<?php
namespace F3\Minesweeper;

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function _testCanCreateGame()
    {
        $game = $this->createGame([
            '  ',
            ' x',
            ' x',
        ]);
        $this->assertView(
            [
                '  ',
                '  ',
                '  ',
            ],
            $game
        );
    }

    public function testClickNextToBombShowsNumber()
    {
        $game = $this->createGame([
            '  ',
            ' x',
            ' x',
        ]);
        $game->click(1, 0);
        $this->assertView(
            [
                ' 1',
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

    private function createGame(array $bomb_map): Game
    {
        $game = new Game(array_map('str_split', $bomb_map));
        return $game;
    }
}
