<?php
declare(strict_types=1);

namespace TicTacToeTest\src\TicTacToe;

use PHPUnit\Framework\TestCase;

class SymbolTest extends TestCase
{
    /**
     * @test
     * @expectedException TicTacToe\Exception\NotAllowedSymbolValue
     */
    public function validate_symbol()
    {
        /**
         * Put here all posible cases of wrong initialization arguments
         */
        $symbol = new \TicTacToe\Symbol('#');
        $symbol = new \TicTacToe\Symbol(0);
        $symbol = new \TicTacToe\Symbol(-1);
        $symbol = new \TicTacToe\Symbol(null);
        $symbol = new \TicTacToe\Symbol(new \stdClass());
        $symbol = new \TicTacToe\Symbol(\json_decode(['x' => 'y']));
    }

    /**
     * @test
     */
    public function get_symbol()
    {
        $symbol = new \TicTacToe\Symbol('X');
        self::assertEquals('X', $symbol->value());

        $symbol = new \TicTacToe\Symbol('0');
        self::assertEquals('0', $symbol->value());
    }
}
