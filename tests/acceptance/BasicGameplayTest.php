<?php
declare(strict_types=1);

namespace TicTacToeTest\acceptance;

use PHPUnit\Framework\TestCase;

use TicTacToe\Game as TicTacToe;
use TicTacToe\Tile;

class BasicGameplayTest extends TestCase
{

    /**
     * @test
     *
     * End result:
     * 0X0
     * -X-
     * -X-
     *
     * Hint: best way of solving a problem is making sure that the problem does
     * not exist in the first place
     */
    public function complete_happy_path_gameplay()
    {
        $game = new TicTacToe();
        list($playerX, $player0) = $game->players('X', '0');
        $playerX->takeTile(new Tile(1, 1));
        $player0->takeTile(new Tile(0, 0));
        $playerX->takeTile(new Tile(0, 1));
        $player0->takeTile(new Tile(0, 2));
        $playerX->takeTile(new Tile(2, 1));
        $this->assertSame($playerX, $game->winner());
    }
}
