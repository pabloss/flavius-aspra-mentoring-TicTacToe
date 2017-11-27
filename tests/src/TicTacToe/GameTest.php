<?php
declare(strict_types=1);

namespace TicTacToeTest\src\TicTacToe;

use PHPUnit\Framework\TestCase;

use TicTacToe\Game as TicTacToe;

class GameTest extends TestCase
{
    /**
     * @test
     */
    public function create_players()
    {
        $game = new TicTacToe();
        list($playerX, $player0) = $game->players('X', '0');
        self::assertInstanceOf('TicTacToe\Player', $playerX);
        self::assertInstanceOf('TicTacToe\Player', $player0);
    }
}
