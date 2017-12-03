<?php
declare(strict_types=1);

namespace TicTacToe;

class Game
{
    const patterns = [
            [
            '#', '#', '#',
            ' ', ' ', ' ',
            ' ', ' ', ' ',
            ],
            [
            ' ', ' ', ' ',
            '#', '#', '#',
            ' ', ' ', ' ',
            ],
            [
            ' ', ' ', ' ',
            ' ', ' ', ' ',
            '#', '#', '#',
            ],
            [
            '#', ' ', ' ',
            '#', ' ', ' ',
            '#', ' ', ' ',
            ],
            [
            ' ', '#', ' ',
            ' ', '#', ' ',
            ' ', '#', ' ',
            ],
            [
            ' ', ' ', '#',
            ' ', ' ', '#',
            ' ', ' ', '#',
            ],
            [
            '#', ' ', ' ',
            ' ', '#', ' ',
            ' ', ' ', '#',
            ],
            [
            ' ', ' ', '#',
            ' ', '#', ' ',
            '#', ' ', ' ',
            ]
        ];

    const OK = 0;
    const DUPLICATED_PLAYERS_ERROR = 1;
    const DUPLICATED_TURNS_ERROR = 2;
    const GAME_STARTED_BY_PLAYER0_ERROR = 4;

    private $board;
    private $history;
    private $lastTurn;

    private $players;

    private $startingPlayerSymbol;

    private $errors;

    public function __construct()
    {
        $this->board = \array_fill(0, 9, null);
        $this->history = [];
        $this->errors = self::OK; // Just to remember: such representation of start value explains initial state
        $this->players = [];
    }

    public function players(Symbol $symbolX, Symbol $symbol0)
    {
        if ($symbolX === $symbol0) {
            $this->errors |= self::DUPLICATED_PLAYERS_ERROR;
        }

        $this->startingPlayerSymbol = $symbolX;

        if (
            empty($this->players) ||
            (
                isset($this->players[$symbolX->value()]) &&
                empty($this->players[$symbolX->value()])
            )
            ||
            (
                isset($this->players[$symbol0->value()]) &&
                empty($this->players[$symbol0->value()])
            )
        ) {
            $this->players[$symbolX->value()] = new Player($symbolX, $this);
            $this->players[$symbol0->value()] = new Player($symbol0, $this);
        }

        return [
            $this->players[$symbolX->value()],
            $this->players[$symbol0->value()]
        ];
    }

    public function board()
    {
        return $this->board;
    }

    public function takeTile(Tile $tile, Player $player)
    {
        if (
            empty($this->lastTurn) &&
            $player->symbol() !== $this->startingPlayerSymbol
        ) {
            $this->errors |= self::GAME_STARTED_BY_PLAYER0_ERROR;
        }

        if ($this->errors() === self::OK) {
            $this->saveLastTurn($player);

            $this->markBoard($tile, $player);

            $this->saveTurnToHistory($tile);
        }
    }

    public function history()
    {
        return $this->history;
    }

    public function winner()
    {
        return $this->findWinnerByBoardPatterns('X') ??
            $this->findWinnerByBoardPatterns('0');
    }

    public function errors()
    {
        return $this->errors;
    }

    private function saveLastTurn(Player $player)
    {
        if (
            !empty($this->lastTurn) &&
            $player->symbol() === $this->lastTurn
        ) {
            $this->errors |= self::DUPLICATED_TURNS_ERROR;
        }
        $this->lastTurn = $player->symbol();
    }

    private function markBoard(Tile $tile, Player $player): void
    {
        $this->board[$tile->column() + 3 * $tile->row()] = $player;
    }

    private function saveTurnToHistory(Tile $tile): void
    {
        $this->history[\count($this->history) % 9] = [$tile->row(), $tile->column()];
    }

    private function countFieldsMatchedToPattern($pattern, $symbol)
    {
        $foundCount = 0;
        // Here were loop, but now I've changed to use native PHP array function
        // I'm not sure if it "improves" performance
        \array_walk(
            $this->board,
            function ($val, $i) use (&$foundCount, $symbol, $pattern) {
                if ($val == $symbol && $pattern[$i] == '#') {
                    $foundCount++;
                }
            }
        );
        return $foundCount;
    }

    private function findWinnerByBoardPatterns($symbol)
    {
        // Here were loop, but now I've changed to use native PHP array function
        // I'm not sure if it "improves" performance
        $found = \array_reduce(
            self::patterns,
            function ($carry, $pattern) use ($symbol) {
                $carry |= (
                    $this->countFieldsMatchedToPattern($pattern, $symbol) === 3
                );
                return $carry;
            },
            false
        );

        if ($found === false) {
            return null;
        }
        return $this->players[$symbol];
    }
}
