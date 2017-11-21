<?php
declare(strict_types=1);

namespace TicTacToe;

class Board
{
    public function getTiles()
    {
        return array_fill(0, 9, ' ');
    }
}
