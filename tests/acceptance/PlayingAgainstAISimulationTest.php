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
    public function random_looped_taken_tiles_should_fill_whole_board()
    {
        $game = new TicTacToe();
        list($playerX, $player0) = $game->players(new Symbol('X'), new Symbol('0'));
        /** @var Player $playerX */
        $playerX->setAsAI();
        for ($i = 2; $i <= 9; $i += 2) {
            $playerX->takeTile();
            /** @var Player $player0 */
            $player0->takeTile($player0->takeRandomFreeTile($game));
        }

        self::assertTrue(
            \is_null($game->winner()) ||
            $game->winner()->symbol()->value() === 'X' ||
            $game->winner()->symbol()->value() === '0'
        );
        $this->visualise_board($game);
    }

    private function visualise_board(TicTacToe $game)
    {
        $board = $game->board();

        if (\is_null($game->winner())) {
            \print_r("\nThere IS NO winner.\n");
        } else {
            \print_r("\nThe winner IS '" .
            $game->winner()->symbol()->value() .
            "' player.\n");
        }

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
