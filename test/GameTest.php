<?php
declare(strict_types=1);

namespace TicTacToeTest;

use TicTacToe\Board;
use TicTacToe\Game;
use PHPUnit\Framework\TestCase;
use TicTacToe\PlayerO;
use TicTacToe\PlayerX;

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
            PlayerX::class
        ));
        self::assertInstanceOf(
            PlayerX::class,
            $this->game->playerX()
        );
    }

    /**
     * @test
     */
    public function gameHasPlayerO()
    {
        self::assertTrue(\class_exists(
            PlayerO::class
        ));
        self::assertInstanceOf(
            PlayerO::class,
            $this->game->playerO()
        );
    }

    /**
     * @test
     */
    public function playerXCanSignHisSignOnBoard()
    {
        /** @var PlayerX $playerX */
        $playerX = $this->game->playerX();

        /** @var Board $board */
        $board = $this->game->board();

        $playerX->sign(1, 1, $board);
        self::assertEquals('X', $board->tile(1, 1));
        self::assertNotEquals('X', $board->tile(2, 1));
    }

    /**
     * @test
     */
    public function playerOCanSignHisSignOnBoard()
    {
        /** @var PlayerO $playerO */
        $playerO = $this->game->playerO();

        /** @var Board $board */
        $board = $this->game->board();
        $playerO->sign(2, 2, $board);
        self::assertEquals('O', $board->tile(2, 2));
        self::assertNotEquals('O', $board->tile(1, 2));
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function boardShouldNotAllowToSignNotExistedTiles()
    {
        /** @var PlayerO $playerO */
        $playerO = $this->game->playerO();

        /** @var Board $board */
        $board = $this->game->board();

        $playerO->sign(4, 4, $board);
        $playerO->sign(0, 0, $board);
        $playerO->sign(-1, -10, $board);
    }
}
