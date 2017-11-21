<?php
declare(strict_types=1);

namespace TicTacToe;

class PlayerX
{
    public function sign($x, $y, $board)
    {
        $board->sign($x, $y, 'X');
    }
}
