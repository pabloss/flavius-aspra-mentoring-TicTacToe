<?php
declare(strict_types=1);

namespace TicTacToe;

class Game
{
    public function players($symbolX, $symbol0)
    {
        return [new Player(), new Player()];
    }
}
