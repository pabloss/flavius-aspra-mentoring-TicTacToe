<?php
declare(strict_types=1);

namespace TicTacToeTest\src\TicTacToe;

use PHPUnit\Framework\TestCase;
use TicTacToe\Game as TicTacToe;
use TicTacToe\Symbol;

class GameTest extends TestCase
{

    /**
     * @test
     */
    public function game_should_record_correct_turns()
    {
        $history = new TicTacToe\History();
        $game = new TicTacToe($history);
        list($playerX, $player0) = $game->players(new Symbol('X'), new Symbol('0'));
        $playerX->takeTile(new \TicTacToe\Tile(0, 0));
        $player0->takeTile(new \TicTacToe\Tile(0, 1));
        $playerX->takeTile(new \TicTacToe\Tile(1, 0));
        $player0->takeTile(new \TicTacToe\Tile(1, 1));
        self::assertEquals([$playerX, $player0, null, $playerX, $player0, null, null, null, null], $game->board());
        self::assertEquals([[0, 0], [0, 1], [1, 0], [1, 1]], $game->history());
    }

    /**
     * @test
     */
    public function game_should_not_produce_new_players_if_ones_already_exist()
    {
        $history = new TicTacToe\History();
        $game = new TicTacToe($history);
        list($playerX1, $player01) = $game->players(new Symbol('X'), new Symbol('0'));
        list($playerX2, $player02) = $game->players(new Symbol('X'), new Symbol('0'));

        self::assertSame($playerX1, $playerX2);
        self::assertSame($player01, $player02);
    }
}
