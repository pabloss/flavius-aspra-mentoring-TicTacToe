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
        $factory = new \TicTacToe\Factory\PlayerFactory();
        $playerX = $factory->createAI('X');
        $player0 = $factory->createReal('0');
        for ($i = 0; $i < 9; $i++) {
            $playerX->takeTile();
            $player0->takeTile($this->findNextFreeTile($game));
        }
        self::assertTrue(
            $game->winner()->symbol()->value() === 'X' ||
            $game->winner()->symbol()->value() === '0'
        );
    }
}
