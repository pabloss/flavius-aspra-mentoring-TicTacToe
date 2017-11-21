<?php
declare(strict_types=1);

namespace TicTacToeTest;

use PHPUnit\Framework\TestCase;
use TicTacToe\Board;

class BoardTest extends TestCase
{
    private $board;

    protected function setUp()
    {
        $this->board = new Board();
    }

    /**
     * @test
     */
    public function boardClassExists()
    {
        self::assertTrue(class_exists(Board::class));
    }
    
    /**
     * @test
     */
    public function boardHasNineTiles()
    {
        self::assertEquals(
            9,
            count($this->board->getTiles())
        );
    }
}
