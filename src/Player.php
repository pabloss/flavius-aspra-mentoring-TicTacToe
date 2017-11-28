<?php
declare(strict_types=1);

namespace TicTacToe;

class Player
{
    private $symbol;
    private $game;

    public function __construct($symbol, $game)
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
        $this->game->takeFile($tile, $this);
    }
}
