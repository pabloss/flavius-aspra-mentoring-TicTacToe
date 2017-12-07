<?php
declare(strict_types=1);

namespace TicTacToeTest\src\TicTacToe\Type;

use PHPUnit\Framework\TestCase;

class PlayerTypeTest extends TestCase
{
    /**
     * @test
     * @expectedException \TicTacToe\Exception\NotAllowedTypeValue
     */
    public function types()
    {
        $type = new \TicTacToe\Type\PlayerType('AI');
        self::assertEquals('AI', $type->value());

        $type = new \TicTacToe\Type\PlayerType('Real');
        self::assertEquals('Real', $type->value());

        $type = new \TicTacToe\Type\PlayerType('#');
    }
}
