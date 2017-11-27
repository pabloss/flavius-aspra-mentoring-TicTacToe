<?php
declare(strict_types=1);

namespace TicTacToeTest\integration;

use PHPUnit\Framework\TestCase;

use TicTacToe\Game as TicTacToe;

class GameTest extends TestCase
{
    /**
     * @test
     */
    public function factor_players()
    {
        $game = new TicTacToe();
        list($playerX, $player0) = $game->players('X', '0');
        self::assertEquals('X', $playerX->symbol());
        self::assertEquals('0', $player0->symbol());
    }
}
