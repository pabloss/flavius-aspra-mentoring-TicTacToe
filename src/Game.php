<?php
declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Exception\DuplicatePlayersException;
use TicTacToe\Exception\DuplicateTurnsException;

class Game
{
    private $board;
    private $history;
    private $lastTurn;

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
        $this->saveLastTurn($player);

        $this->markBoard($tile, $player);

        $this->saveTurnToHistory($tile);
    }

    public function history()
    {
        return $this->history;
    }

    private function saveLastTurn(Player $player)
    {
        if (
            !empty($this->lastTurn) &&
            $player->symbol() === $this->lastTurn
        ) {
            throw new DuplicateTurnsException();
        }
        $this->lastTurn = $player->symbol();
    }

    private function markBoard(Tile $tile, Player $player): void
    {
        $this->board[$tile->column() + 3 * $tile->row()] = $player->symbol();
    }

    private function saveTurnToHistory(Tile $tile): void
    {
        $this->history[\count($this->history) % 9] = [$tile->row(), $tile->column()];
    }
}
