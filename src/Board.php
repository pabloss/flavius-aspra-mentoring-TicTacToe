<?php
declare(strict_types=1);

namespace TicTacToe;

class Board
{
    public function tile()
    {
        return 'X';
    }
    
    public function getTiles()
    {
        return array_fill(0, 9, ' ');
    }
}
