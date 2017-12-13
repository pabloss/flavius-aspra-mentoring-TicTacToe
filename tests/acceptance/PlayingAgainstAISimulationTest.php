<?php
declare(strict_types=1);

namespace TicTacToeTest\acceptance;

use PHPUnit\Framework\TestCase;
use TicTacToe\AI\AIPlayer;
use TicTacToe\Game as TicTacToe;
use TicTacToe\Symbol;
use TicTacToe\Tile;

class PlayingAgainstAISimulationTest extends TestCase
{
    /**
     * @test
     */
    public function two_ais_gameplay()
    {
        $game = new TicTacToe();
        list($playerX, $player0) = $game->players(new Symbol('X'), new Symbol('0'));
        $playerX->setAsAI();
        $player0->setAsAI();

        for ($i = 2; $i <= 9; $i += 2) {
            $playerX->takeTile();
            $player0->takeTile();
        }
        self::assertTrue(
            $game->winner()->symbol()->value() === 'X' ||
            $game->winner()->symbol()->value() === '0'
        );
        $this->visualise_board($game->board());
    }

    private function visualise_board($board)
    {
        \print_r("\nThe board has " . \count($board). " Tiles.\n\n");
        \print_r("Here is how the board looks like at the end of game below:\n");
        \print_r("----------------------------------------------------------\n");
        foreach ($board as $i => $value) {
            if ($i % 3 ===0) {
                \print_r("\n");
            }
            \print_r("|");
            if (!empty($value)) {
                \print_r($value->symbol()->value());
            } else {
                \print_r("_");
            }
            \print_r("|");
        }
        \print_r("\n\n----------------------------------------------------------\n");
    }
}
