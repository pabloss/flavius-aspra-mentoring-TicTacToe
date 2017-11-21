<?php
declare(strict_types=1);
namespace TicTacToeTest;

use PHPUnit\Framework\TestCase;

class TestTest extends TestCase
{
    /**
     * @test
     */
    public function self()
    {
        $game = new TicTacToe\Test();
        self::assertTrue(is_object($game));
    }
}
