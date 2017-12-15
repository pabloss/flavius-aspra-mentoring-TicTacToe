<?php
declare(strict_types=1);

namespace TicTacToe;

class Player
{
    private $symbol;
    private $game;

    public function __construct(Symbol $symbol, Game  $game)
    {
        $this->symbol = $symbol;
        $this->game = $game;
    }


    public function symbol()
    {
        return $this->symbol;
    }

    public function takeTile(Tile $tile)
    {
        $player = $this;
        $callback = function () use ($player, $tile) {
            return $this->takeTile($player, $tile);
        };

        return $callback->call($this->game);
    }
}
