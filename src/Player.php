<?php
declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Type\PlayerType as Type;

class Player
{
    private $symbol;
    private $game;
    private $type;

    public function __construct(Symbol $symbol, Game $game, Type $type)
    {
        $this->symbol = $symbol;
        $this->game = $game;
        $this->type = $type;
    }


    public function symbol()
    {
        return $this->symbol;
    }

    public function takeTile(Tile $tile)
    {
        $player = $this;
        $callback = function () use ($tile, $player) {
            $this->takeTile($tile, $player);
        };

        $callback->call($this->game);
    }

    public function type()
    {
        return $this->type;
    }
}
