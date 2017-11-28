<?php
declare(strict_types=1);

namespace TicTacToeTest\integration;

use PHPUnit\Framework\TestCase;

use TicTacToe\Game as TicTacToe;

class GameTest extends TestCase
{
    /**
     * @test
     */
    public function factor_players()
    {
        $game = new TicTacToe();
        list($playerX, $player0) = $game->players('X', '0');
        self::assertEquals('X', $playerX->symbol());
        self::assertEquals('0', $player0->symbol());
    }

    /**
     * @test
     * @expectedException TicTacToe\Exception\DuplicatePlayersException
     */
    public function duplicate_players_not_allowed()
    {
        $game = new TicTacToe();
        $game->players('X', 'X');
    }

    /**
     * @test
     * @expectedException TicTacToe\Exception\DuplicateTurnsException
     */
    public function players_take_turns()
    {
        $game = new \TicTacToe\Game();
        list($playerX, $player0) = $game->players('X', '0');
        $playerX->takeTile(new \TicTacToe\Tile(0, 0));
        $playerX->takeTile(new \TicTacToe\Tile(1, 1));
    }
}
