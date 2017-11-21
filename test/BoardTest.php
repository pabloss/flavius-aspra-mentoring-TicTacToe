<?php
declare(strict_types=1);

namespace TicTacToeTest;

use PHPUnit\Framework\TestCase;
use TicTacToe\Board;

class BoardTest extends TestCase
{
    /**
     * @test
     */
    public function boardClassExists()
    {
        self::assertTrue(class_exists(Board::class));
    }
}
