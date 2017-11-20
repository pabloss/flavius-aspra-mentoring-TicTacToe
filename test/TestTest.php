<?php
declare(strict_types=1);
namespace TicTacToeTest;

include dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

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
