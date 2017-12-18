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

class PlayingAgainstAISimulationTest extends TestCase
{
    /** @var  TicTacToe $game */
    private $game;

    /**
     * @test
     */
    public function random_looped_taken_tiles_should_fill_whole_board()
    {
        $history = new TicTacToe\History();
        $game = new TicTacToe($history);
        $this->game = $game;
        list($playerX, $player0) = $game->players(new Symbol('X'), new Symbol('0'));
        $ai = new AI($game);
        for ($i = 2; $i <= 9; $i += 2) {
            $playerX->takeTile($ai->takeRandomFreeTile());
            /** @var Player $player0 */
            $player0->takeTile($this->simulate_choosing_tiles_of_real_player());
        }

        self::assertTrue(
            \is_null($game->winner()) ||
            $game->winner()->symbol()->value() === 'X' ||
            $game->winner()->symbol()->value() === '0'
        );
        self::assertTrue(\array_reduce($game->board(), function ($carry, $value) {
            $carry = $carry || (\is_null($value) === false);
            return $carry;
        }, false));
    }

    private function simulate_choosing_tiles_of_real_player()
    {
        $ai = new AI($this->game);
        return $ai->takeRandomFreeTile();
    }
}
