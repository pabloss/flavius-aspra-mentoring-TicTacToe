<?php
declare(strict_types=1);

namespace TicTacToeTest\src\TicTacToe;

use PHPUnit\Framework\TestCase;
use TicTacToe\Game as TicTacToe;
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
        $game = new TicTacToe();
        $symbol = new Symbol(Symbol::PLAYER_X_SYMBOL);

        $player = new Player($symbol, $game);
        self::assertEquals($symbol, $player->symbol());
    }

    /**
     * @test
     */
    public function ai_player_checking_type()
    {
        $game = new TicTacToe();
        $symbol = new Symbol(Symbol::PLAYER_X_SYMBOL);

        $player = new Player($symbol, $game);
        self::assertEquals(new Type(Type::REAL_TYPE), $player->type());

        $player->setAsReal();
        self::assertEquals(new Type(Type::REAL_TYPE), $player->type());

        $player->setAsAI();
        self::assertEquals(new Type(Type::AI_TYPE), $player->type());
    }
}
