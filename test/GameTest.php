<?php
declare(strict_types=1);

namespace TicTacToeTest;

use TicTacToe\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    /**
     * @test
     */
    public function gameClassExists()
    {
        self::assertTrue(class_exists(Game::class));
    }
}
