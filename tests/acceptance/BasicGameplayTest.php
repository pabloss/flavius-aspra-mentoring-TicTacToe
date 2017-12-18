<?php
declare(strict_types=1);

namespace TicTacToeTest\acceptance;

use PHPUnit\Framework\TestCase;

use TicTacToe\Game as TicTacToe;
use TicTacToe\Symbol;
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
        $history = new TicTacToe\History();
        $game = new TicTacToe($history);
        list($playerX, $player0) = $game->players(new Symbol('X'), new Symbol('0'));
        $playerX->takeTile(new Tile(1, 1));
        $player0->takeTile(new Tile(0, 0));
        $playerX->takeTile(new Tile(0, 1));
        $player0->takeTile(new Tile(0, 2));
        $playerX->takeTile(new Tile(2, 1));
        $this->assertSame($playerX, $game->winner());
    }

    /**
     * @test
     */
    public function complete_happy_path_gameplay_other_player_wins()
    {
        // We are swapping players
        $history = new TicTacToe\History();
        $game = new TicTacToe($history);
        list($playerX, $player0) = $game->players(new Symbol('X'), new Symbol('0'));
        $playerX->takeTile(new Tile(2, 2));
        $player0->takeTile(new Tile(1, 1));
        $playerX->takeTile(new Tile(0, 0));
        $player0->takeTile(new Tile(0, 1));
        $playerX->takeTile(new Tile(0, 2));
        $player0->takeTile(new Tile(2, 1));
        $this->assertSame($player0, $game->winner());
    }
}
