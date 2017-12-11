<?php
declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Type\PlayerType as Type;

class Player
{
    private $symbol;
    private $game;
    private $type;

    public function __construct(Symbol $symbol, Game $game)
    {
        $this->symbol = $symbol;
        $this->game = $game;
        $this->type = new Type(Type::REAL_TYPE);
    }


    public function symbol()
    {
        return $this->symbol;
    }

    public function takeTile(Tile $tile = null)
    {
        if (
            \is_null($tile) &&
            $this->type()->value() === Type::REAL_TYPE
        ) {
            $setGameErrorCallback = function () {
                $this->errors |= Game::PLAYER_IS_NOT_AI_ERROR;
            };

            $setGameErrorCallback->call($this->game);
        }

        if (
            \is_null($tile) &&
            $this->type()->value() === Type::AI_TYPE
        ) {
            $tile = $this->takeRandomFreeTile($this->game);
        }

        $player = $this;
        $callback = function () use ($tile, $player) {
            $this->takeTile($player, $tile);
        };

        return $callback->call($this->game);
    }

    public function takeRandomFreeTile(Game $game)
    {
        $board = $game->board();
        return new Tile(0, 0);
    }

    public function type()
    {
        return $this->type;
    }

    public function setAsAI()
    {
        $this->type = new Type(Type::AI_TYPE);
    }

    public function setAsReal()
    {
        $this->type = new Type(Type::REAL_TYPE);
    }
}
