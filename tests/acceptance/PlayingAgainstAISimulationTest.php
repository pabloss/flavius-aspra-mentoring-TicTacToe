<?php
declare(strict_types=1);

namespace TicTacToeTest\acceptance;

use PHPUnit\Framework\TestCase;
use TicTacToe\Game as TicTacToe;
use TicTacToe\Symbol;
use TicTacToe\Tile;

class PlayingAgainstAISimulationTest extends TestCase
{
    /**
     * @test
     */
    public function simulation_steps()
    {
        $game = new TicTacToe();
        list($aiPlayer, $player0) = $game->realAndAIPLayerPair(new Symbol('X'), new Symbol('0'));
        for($i = 0; $i < 9; $i++){

            // AI Turn
            $aiPlayer->takeTile();
            $history = $game->history();
            list($aiTakenColumn, $aiTakenRow) = end($history);

            // Plain Player Turn

            /**
             * let's choose random tile but don't already choosen
             */
            // take current baord state
            $board = $game->board();
            // find only nulled fields
            $nulledFieldPositions = []
            \array_walk($board, function ($item, $key) use (&$nulledFieldPositions){
                if(is_null($item)){
                    $nulledFieldPositions[] = $key;
                }
            });
            // from $nulledFieldPositions above take one (these are not already have touched tiles positions)
            $player0->takeTile(new Tile(1, 1));
            $history = $game->history();
            list($player0TakenColumn, $player0TakenRow) = end($history);

            self::assertNotEquals(
                [
                    $player0TakenRow,
                    $player0TakenRow
                ],
                [
                    $aiTakenColumn,
                    $aiTakenRow
                ]
            );
        }

    }
}
