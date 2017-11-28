<?php
declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Exception\DuplicatePlayersException;

class Game
{
    public function players($symbolX, $symbol0)
    {
        if ($symbolX === $symbol0) {
            throw new DuplicatePlayersException();
        }
        return [new Player($symbolX), new Player($symbol0)];
    }
}
