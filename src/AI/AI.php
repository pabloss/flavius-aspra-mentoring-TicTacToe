<?php
declare(strict_types=1);

namespace TicTacToe\AI;

use TicTacToe\Game as TicTacToe;
use TicTacToe\Tile;

class AI
{
    private $game;

    public function __construct(TicTacToe $game)
    {
        $this->game = $game;
    }


    public function takeRandomFreeTile()
    {
        $board = $this->game->board();
        $freeTileIndexes = $this->takeFreeTileIndexes($board);
        $randomIndex = $this->chooseRandomIndex($freeTileIndexes);
        list($column, $row) = $this->coordinatesFromIndex($randomIndex);
        return new Tile($row, $column);
    }

    private function takeFreeTileIndexes(array $board)
    {
        $freeTileIndexes = [];
        \array_walk($board, function ($value, $key) use (&$freeTileIndexes) {
            if (\is_null($value)) {
                $freeTileIndexes[] = $key;
            }
        });
        return $freeTileIndexes;
    }

    private function chooseRandomIndex(array $freeTileIndexes)
    {
        $arrayLength = \count($freeTileIndexes);
        return $freeTileIndexes[\rand(0, $arrayLength - 1)];
    }

    private function coordinatesFromIndex($randomIndex): array
    {
        $column = $randomIndex % 3;
        $row = \intval(\floor($randomIndex / 3.0));
        return array($column, $row);
    }
}
