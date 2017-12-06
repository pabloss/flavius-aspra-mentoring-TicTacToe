<?php
declare(strict_types=1);

namespace TicTacToeTest\acceptance;

use PHPUnit\Framework\TestCase;
use TicTacToe\AI\AIPlayer;
use TicTacToe\Game as TicTacToe;
use TicTacToe\Player;
use TicTacToe\Symbol;
use TicTacToe\Tile;

class PlayingAgainstAISimulationTest extends TestCase
{
    /**
     * @test
     */
    public function random_looped_taken_tilles_should_fill_whole_board()
    {
        $game = new TicTacToe();
        list($aiPlayer, $player0) = $game->realAndAIPLayerPair(new Symbol('X'), new Symbol('0'));

        self::assertEquals(9, \count($game->board()));
        for ($i = 0; $i < 9; $i++) {
            /** @var AIPlayer $aiPlayer */
            $aiPlayer->takeTile();
            self::assertEquals(8 - $i, \count($game->board()));
        }
    }
}
