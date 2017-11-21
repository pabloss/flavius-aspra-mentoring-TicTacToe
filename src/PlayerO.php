<?php
declare(strict_types=1);

namespace TicTacToe;

class PlayerO
{
    public function sign($x, $y, $board)
    {
        $board->sign($x, $y, 'O');
    }
}
