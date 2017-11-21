<?php
declare(strict_types=1);

namespace TicTacToe;

class Game
{
    public function playerX()
    {
        return new PlayerX();
    }

    public function playerO()
    {
        return new PlayerO();
    }
}
