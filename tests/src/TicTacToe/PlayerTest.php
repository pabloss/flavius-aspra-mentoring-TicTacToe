<?php
declare(strict_types=1);

namespace TicTacToeTest\src\TicTacToe;

use PHPUnit\Framework\TestCase;
use TicTacToe\Game;
use TicTacToe\Player;
use TicTacToe\Symbol;
use TicTacToe\Type\PlayerType as Type;

class PlayerTest extends TestCase
{
    /**
     * @test
     */
    public function player_has_symbol()
    {
        $player = new Player(new Symbol('X'), new Game(), new Type(Type::AI_TYPE));
        self::assertEquals(new Symbol('X'), $player->symbol());
        self::assertEquals(new Type('AI'), $player->type());
    }
}
