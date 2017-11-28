<?php
declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Exception\DuplicatePlayersException;

class Game
{
    private $board;
    private $history;

    public function __construct()
    {
        $this->board = \array_fill(0, 9, ' ');
        $this->history = [];
    }

    public function players($symbolX, $symbol0)
    {
        if ($symbolX === $symbol0) {
            throw new DuplicatePlayersException();
        }
        return [new Player($symbolX, $this), new Player($symbol0, $this)];
    }

    public function board()
    {
        return $this->board;
    }

    public function takeFile(Tile $tile, Player $player)
    {
        $this->board[$tile->column() + 3*$tile->row()] = $player->symbol();
        $this->history[\count($this->history) % 9] = [$tile->row(), $tile->column()];
    }

    public function history()
    {
        return $this->history;
    }
}
