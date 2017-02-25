<?php
namespace F3\Minesweeper;

use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testCanCreateGame()
    {
        $game = new Game(2, 3);
        $this->assertEquals(
            [
                [' ', ' '],
                [' ', ' '],
                [' ', ' '],
            ],
            $game->getView()
        );
    }

}
