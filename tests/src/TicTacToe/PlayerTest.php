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
        $history = new TicTacToe\History();
        $game = new TicTacToe($history);
        $symbol = new Symbol(Symbol::PLAYER_X_SYMBOL);

        $player = new Player($symbol, $game);
        self::assertEquals($symbol, $player->symbol());
    }
}
