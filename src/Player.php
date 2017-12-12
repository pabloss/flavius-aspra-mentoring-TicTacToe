<?php
declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Type\PlayerType as Type;

class Player
{
    private $symbol;
    private $game;
    private $type;

    public function __construct(Symbol $symbol, Game $game)
    {
        $this->symbol = $symbol;
        $this->game = $game;
        $this->type = new Type(Type::REAL_TYPE);
    }


    public function symbol()
    {
        return $this->symbol;
    }

    public function takeTile(Tile $tile = null)
    {
        if (
            \is_null($tile) &&
            $this->type()->value() === Type::REAL_TYPE
        ) {
            $setGameErrorCallback = function () {
                $this->errors |= Game::PLAYER_IS_NOT_AI_ERROR;
            };

            $setGameErrorCallback->call($this->game);
        }

        if (
            \is_null($tile) &&
            $this->type()->value() === Type::AI_TYPE
        ) {
            $tile = $this->takeRandomFreeTile($this->game);
        }

        $callback = function ($player, $tile) {
            return $this->takeTile($player, $tile);
        };

        $player = $this;
        return $callback->call($this->game, $player, $tile);
    }

    public function takeRandomFreeTile(Game $game)
    {
        $board = $game->board();
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

    public function type()
    {
        return $this->type;
    }

    public function setAsAI()
    {
        $this->type = new Type(Type::AI_TYPE);
    }

    public function setAsReal()
    {
        $this->type = new Type(Type::REAL_TYPE);
    }

    /**
     * @param $randomIndex
     * @return array
     */
    private function coordinatesFromIndex($randomIndex): array
    {
        $column = $randomIndex % 3;
        $row = \intval(\floor($randomIndex / 3.0));
        return array($column, $row);
    }
}
