<?php
declare(strict_types=1);

namespace TicTacToe;

class Player
{
    private $symbol;

    public function __construct($symbol)
    {
        $this->symbol = $symbol;
    }


    public function symbol()
    {
        return $this->symbol;
    }
}
