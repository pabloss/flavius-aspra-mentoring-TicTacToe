<?php
declare(strict_types=1);

namespace TicTacToeTest\acceptance;

use PHPUnit\Framework\TestCase;
use TicTacToe\Game as TicTacToe;
use TicTacToe\Tile;

class PlayingAgainstAISimulationTest extends TestCase
{
    /**
     * @test
     */
    public function simulation_steps()
    {
        $game = new TicTacToe();
        list($playerX, $player0) = $game->realAndAIPLayerPair(new Symbol('X'), new Symbol('0'));
        /** @var Tile $playerXTakenTile */
        $playerXTakenTile = $playerX->takeTile(new Tile(1, 1));
        /** @var Tile $aiTakenTile */
        $aiTakenTile = $playerY->takeTile();
        self::assertNotEquals(
            [
                $playerXTakenTile->column(),
                $playerXTakenTile->row()
            ],
            [
                $aiTakenTile->column(),
                $aiTakenTile->row()
            ]
        );
    }
}
