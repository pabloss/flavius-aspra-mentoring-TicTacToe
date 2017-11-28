<?php
declare(strict_types=1);

namespace TicTacToeTest\src\TicTacToe;

use PHPUnit\Framework\TestCase;

use TicTacToe\Game as TicTacToe;

class GameTest extends TestCase
{
    /**
     * @test
     */
    public function create_players()
    {
        $game = new TicTacToe();
        list($playerX, $player0) = $game->players('X', '0');
        self::assertInstanceOf('TicTacToe\Player', $playerX);
        self::assertInstanceOf('TicTacToe\Player', $player0);
    }
    
    /**
     * @test
     */
    public function game_should_record_correct_turns()
    {
        $game = new TicTacToe();
        list($playerX, $player0) = $game->players('X', '0');
        $playerX->takeTile(new \TicTacToe\Tile(0, 0));
        $player0->takeTile(new \TicTacToe\Tile(0, 1));
        $playerX->takeTile(new \TicTacToe\Tile(1, 0));
        $player0->takeTile(new \TicTacToe\Tile(1, 1));
        self::assertEquals(['X', ' ', ' ', ' ', '0', 'X', ' ', '0', ' '], $game->board());
    }
}
