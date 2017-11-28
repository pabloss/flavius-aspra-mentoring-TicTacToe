<?php
declare(strict_types=1);

namespace TicTacToeTest\src\TicTacToe;

use PHPUnit\Framework\TestCase;
use TicTacToe\Tile;

class TileTest extends TestCase
{
    /**
     * @test
     */
    public function gets_row_and_column()
    {
        $tile = new Tile(1, 2);
        self::assertEquals(1, $tile->row());
        self::assertEquals(2, $tile->column());
    }
}
