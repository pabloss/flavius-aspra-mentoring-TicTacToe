<?php
declare(strict_types=1);

namespace TicTacToeTest\integration;

use PHPUnit\Framework\TestCase;
use TicTacToe\AI\AI;
use TicTacToe\Game as TicTacToe;
use TicTacToe\Player;
use TicTacToe\Symbol;
use TicTacToe\Tile;

class PlayerTest extends TestCase
{
    /** @var  TicTacToe $game */
    private $game;

    /**
     * @test
     */
    public function looping_AI_player_fills_whole_board_in_9_turns()
    {
        $history = new TicTacToe\History();
        $game = new TicTacToe($history);
        $ai = new AI($game);
        $this->game = $game;
        $symbolX = new Symbol(Symbol::PLAYER_X_SYMBOL);
        $symbol0 = new Symbol(Symbol::PLAYER_0_SYMBOL);
        list($player, $notUsedPlayer) = $game->players($symbolX, $symbol0);
        for (
            $expectedFilledCount = 2;
            $expectedFilledCount <= 9;
            $expectedFilledCount += 2
        ) {
            $player->takeTile($ai->takeRandomFreeTile());
            $notUsedPlayer->takeTile($this->simulate_choosing_tiles_of_real_player());
            $actualFilledCount = \array_reduce($game->board(), function ($carry, $item) {
                if (\is_null($item) === false) {
                    $carry++;
                }
                return $carry;
            }, 0);

            $allFreeTileIndexes = [];
            $allFilledTileIndexes = [];
            \array_walk($game->board(), function ($value, $key) use (&$allFreeTileIndexes, &$allFilledTileIndexes) {
                if (\is_null($value) === true) {
                    $allFreeTileIndexes[] = $key;
                } else {
                    $allFilledTileIndexes[] = $key;
                }
            });
            self::assertEquals(0, \count(\array_intersect($allFreeTileIndexes, $allFilledTileIndexes)));
            self::assertEquals(9, \count($allFreeTileIndexes) + \count($allFilledTileIndexes));
            self::assertEquals(
                $expectedFilledCount,
                $actualFilledCount
            );
        }
    }

    private function simulate_choosing_tiles_of_real_player()
    {
        $ai = new AI($this->game);
        return $ai->takeRandomFreeTile();
    }
}
