<?php
declare(strict_types=1);

namespace TicTacToeTest\src\TicTacToe;

use PHPUnit\Framework\TestCase;

use TicTacToe\Game as TicTacToe;
use TicTacToe\Symbol;
use TicTacToe\Type\PlayerType as Type;

class GameTest extends TestCase
{

    /**
     * @test
     */
    public function game_should_record_correct_turns()
    {
        $game = new TicTacToe();
        list($playerX, $player0) = $game->players(
            [
                'symbol' => new Symbol(Symbol::PLAYER_X_SYMBOL),
                'type' => new Type(Type::REAL_TYPE),
            ],
            [
                'symbol' => new Symbol(Symbol::PLAYER_0_SYMBOL),
                'type' => new Type(Type::REAL_TYPE),
            ]
        );
        $playerX->takeTile(new \TicTacToe\Tile(0, 0));
        $player0->takeTile(new \TicTacToe\Tile(0, 1));
        $playerX->takeTile(new \TicTacToe\Tile(1, 0));
        $player0->takeTile(new \TicTacToe\Tile(1, 1));
        self::assertEquals([$playerX, $player0, null, $playerX, $player0, null, null, null, null], $game->board());
        self::assertEquals([[0, 0], [0, 1], [1, 0], [1, 1]], $game->history());
    }

    /**
     * @test
     */
    public function game_should_not_produce_new_players_if_ones_already_exist()
    {
        $game = new TicTacToe();
        list($playerX1, $player01) = $game->players(
            [
                'symbol' => new Symbol(Symbol::PLAYER_X_SYMBOL),
                'type' => new Type(Type::REAL_TYPE),
            ],
            [
                'symbol' => new Symbol(Symbol::PLAYER_0_SYMBOL),
                'type' => new Type(Type::REAL_TYPE),
            ]
        );
        list($playerX2, $player02) = $game->players(
            [
                'symbol' => new Symbol(Symbol::PLAYER_X_SYMBOL),
                'type' => new Type(Type::REAL_TYPE),
            ],
            [
                'symbol' => new Symbol(Symbol::PLAYER_0_SYMBOL),
                'type' => new Type(Type::REAL_TYPE),
            ]
        );

        self::assertSame($playerX1, $playerX2);
        self::assertSame($player01, $player02);
    }

    /**
     * @test
     * @expectedException TicTacToe\Exception\SymbolMissedException
     */
    public function players_data_should_have_symbol()
    {
        $game = new TicTacToe();
        list($playerX1, $player01) = $game->players(
            [
                'type' => new Type(Type::REAL_TYPE),
            ],
            [
                'type' => new Type(Type::REAL_TYPE),
            ]
        );
    }
}
