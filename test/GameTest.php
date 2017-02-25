<?php
namespace F3\Minesweeper;

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testCanCreateBoard()
    {
        $board = $this->createBoard([
            '  ',
            ' x',
            ' x',
        ]);
        $this->assertBoard(
            [
                '  ',
                '  ',
                '  ',
            ],
            $board
        );
    }

    public function testClickNextToBombShowsNumber()
    {
        $board = $this->createBoard([
            '  ',
            ' x',
            ' x',
        ]);
        $this->click($board, 1, 0);
        $this->assertBoard(
            [
                ' 1',
                '  ',
                '  ',
            ],
            $board
        );
    }

    public function testClickOnEmptyCellOpensAdjacentEmptyCells()
    {
        $board = $this->createBoard([
            '   ',
            '   ',
            '  x',
            '  x',
        ]);
        $this->click($board, 0, 0);
        $this->assertBoard(
            [
                '000',
                '011',
                '02 ',
                '02 ',
            ],
            $board
        );
    }

    public function testMaxNumberOfBombs()
    {
        $board = $this->createBoard([
            'xxx',
            'x x',
            'xxx',
        ]);
        $this->click($board, 1, 1);
        $this->assertBoard(
            [
                '   ',
                ' 8 ',
                '   ',
            ],
            $board
        );
    }

    public function testClickOnBombShowsAllBombs()
    {
        $board = $this->createBoard([
            'x  ',
            'x x',
            ' xx',
        ]);
        $this->click($board, 1, 2);
        $this->assertBoard(
            [
                'x  ',
                'x x',
                ' xx',
            ],
            $board
        );
    }

    private function click(Board $board, int $x, int $y)
    {
        (new Game($board))->click(new Point($x, $y));
    }

    private function assertBoard(array $view, Board $board)
    {
        $this->assertEquals(
            array_map('str_split', $view),
            $board->toArray()
        );
    }

    private function createBoard(array $bomb_map): Board
    {
        return new Board(
            new BombMap(
                array_map('str_split', $bomb_map)
            )
        );
    }
}
