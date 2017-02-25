<?php
namespace F3\Minesweeper;

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testCanCreateGame()
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

    public function testClickOnEmptyCellOpensAdjacentEmptyCells()
    {
        $game = $this->createGame([
            '   ',
            '   ',
            '  x',
            '  x',
        ]);
        $game->click(0, 0);
        $this->assertView(
            [
                '000',
                '011',
                '02 ',
                '02 ',
            ],
            $game
        );
    }

    public function testMaxNumberOfBombs()
    {
        $game = $this->createGame([
            'xxx',
            'x x',
            'xxx',
        ]);
        $game->click(1, 1);
        $this->assertView(
            [
                '   ',
                ' 8 ',
                '   ',
            ],
            $game
        );
    }

    public function testClickOnBombShowsAllBombs()
    {
        $game = $this->createGame([
            'x  ',
            'x x',
            ' xx',
        ]);
        $game->click(1, 2);
        $this->assertView(
            [
                'x  ',
                'x x',
                ' xx',
            ],
            $game
        );
    }

    private function assertView(array $view, Game $game)
    {
        $this->assertEquals(
            array_map('str_split', $view),
            $game->getBoard()
        );
    }

    private function createGame(array $bomb_map): Game
    {
        return new Game(
            new Board(
                new BombMap(
                    array_map('str_split', $bomb_map)
                )
            )
        );
    }
}
