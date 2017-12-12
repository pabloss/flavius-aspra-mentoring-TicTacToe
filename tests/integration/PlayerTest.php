<?php
declare(strict_types=1);

namespace TicTacToeTest\integration;

use PHPUnit\Framework\TestCase;
use TicTacToe\Game as TicTacToe;
use TicTacToe\Player;
use TicTacToe\Symbol;
use TicTacToe\Tile;

class PlayerTest extends TestCase
{
    /**
     * @test
     */
    public function when_player_set_as_AI_it_allows_to_choose_tile_by_itself()
    {
        $game = new TicTacToe();
        $symbol = new Symbol(Symbol::PLAYER_X_SYMBOL);
        $player = new Player($symbol, $game);
        $player->setAsAI();
        self::assertInstanceOf(Tile::class, $player->takeTile());
        $player->setAsReal();
        $player->takeTile();
        self::assertEquals(
            TicTacToe::PLAYER_IS_NOT_AI_ERROR,
            $game->errors() & TicTacToe::PLAYER_IS_NOT_AI_ERROR
        );
    }

    /**
     * @test
     */
    public function looping_AI_player_fills_whole_board_in_9_turns()
    {
        $game = new TicTacToe();
        $symbolX = new Symbol(Symbol::PLAYER_X_SYMBOL);
        $symbol0 = new Symbol(Symbol::PLAYER_0_SYMBOL);
        list($player, $notUsedPlayer) = $game->players($symbolX, $symbol0);
        $player->setAsAI();
        $notUsedPlayer->setAsAI();
        for (
            $expectedFilledCount = 2;
            $expectedFilledCount <= 9;
            $expectedFilledCount += 2
        ) {
            $player->takeTile();
            $notUsedPlayer->takeTile();
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
}
