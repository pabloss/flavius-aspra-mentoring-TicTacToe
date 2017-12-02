<?php
declare(strict_types=1);

namespace TicTacToeTest\src\TicTacToe;

use PHPUnit\Framework\TestCase;
use TicTacToe\Game;
use TicTacToe\Player;
use TicTacToe\Symbol;

class PlayerTest extends TestCase
{
    /**
     * @test
     */
    public function player_has_symbol()
    {
        $player = new Player(new Symbol('X'), new Game());
        self::assertEquals(new Symbol('X'), $player->symbol());
    }
}
