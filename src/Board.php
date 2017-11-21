<?php
declare(strict_types=1);

namespace TicTacToe;

class Board
{
    private $tiles = [];

    public function __construct()
    {
        $this->tiles = array_fill(0, 9, ' ');
    }

    public function tile($x, $y)
    {
        return $this->tiles[($y - 1) * 3 + $x];
    }
    
    public function getTiles()
    {
        return $this->tiles;
    }

    public function sign($x, $y, $char)
    {
        $this->tiles[($y - 1) * 3 + $x] = $char;
    }
}
