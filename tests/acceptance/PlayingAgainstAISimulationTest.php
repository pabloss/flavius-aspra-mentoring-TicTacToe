<?php
declare(strict_types=1);

namespace TicTacToeTest\acceptance;

use PHPUnit\Framework\TestCase;
use TicTacToe\AI\AI;
use TicTacToe\AI\AIPlayer;
use TicTacToe\Game as TicTacToe;
use TicTacToe\Player;
use TicTacToe\Symbol;
use TicTacToe\Tile;
use TicTacToe\Type\PlayerType as Type;

class PlayingAgainstAISimulationTest extends TestCase
{
    /**
     * @test
     */
    public function random_looped_taken_tilles_should_fill_whole_board()
    {
        $game = new TicTacToe();
        list($playerX, $player0) = $game->players(new Symbol('X'), new Symbol('0'));
        $ai = new AI();
        for ($i = 0; $i < 9; $i++) {
            $playerX->takeTile($ai->chooseFreeTile());
            $player0->takeTile($ai->chooseFreeTile());
        }
        self::assertTrue(
            $game->winner()->symbol()->value() === 'X' ||
            $game->winner()->symbol()->value() === '0'
        );
    }
}
