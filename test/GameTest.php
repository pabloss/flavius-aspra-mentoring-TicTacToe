<?php
declare(strict_types=1);

namespace TicTacToeTest;

use TicTacToe\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    private $game;

    protected function setUp()
    {
        $this->game = new Game();
    }

    /**
     * @test
     */
    public function gameClassExists()
    {
        self::assertTrue(class_exists(Game::class));
    }
    
    /**
     * @test
     */
    public function gameHasPlayerX()
    {
        self::assertTrue(\class_exists(
            "TicTacToe\PlayerX"
        ));
        self::assertInstanceOf(
            "TicTacToe\PlayerX",
            $this->game->playerX()
        );
    }

    /**
     * @test
     */
    public function gameHasPlayerO()
    {
        self::assertTrue(\class_exists(
            "TicTacToe\PlayerO"
        ));
        self::assertInstanceOf(
            "TicTacToe\PlayerO",
            $this->game->playerO()
        );
    }
}
