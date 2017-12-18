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

    public function __construct(\TictacToe\Game\History $history)
    {
        $this->board = \array_fill(0, 9, null);
        $this->history = $history;
        $this->errors = self::OK; // Just to remember: such representation of start value explains initial state
        $this->players = [];
    }

    public function players(Symbol $symbolX, Symbol $symbol0)
    {
        if ($symbolX == $symbol0) {
            $this->errors |= self::DUPLICATED_PLAYERS_ERROR;
        }

        $this->startingPlayerSymbol = $symbolX;

        if (empty($this->players)) {
            $this->players[$symbolX->value()] = new Player($symbolX, $this);
            $this->players[$symbol0->value()] = new Player($symbol0, $this);
        }

        return [
            $this->players[$symbolX->value()],
            $this->players[$symbol0->value()]
        ];
    }

    public function &board()
    {
        return $this->board;
    }

    public function &history()
    {
        return $this->history->content();
    }

    public function winner()
    {
        return
            $this->findWinnerByBoardPatterns(new Symbol(Symbol::PLAYER_X_SYMBOL)) ??
            $this->findWinnerByBoardPatterns(new Symbol(Symbol::PLAYER_0_SYMBOL));
    }

    public function errors()
    {
        return $this->errors;
    }

    private function takeTile(Player $player, Tile $tile)
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
        
        return $tile;
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
        $this->history->set([$tile->row(), $tile->column()]);
    }

    private function countFieldsMatchedToPattern($pattern, Symbol $symbol)
    {
        $foundCount = 0;
        // Here were loop, but now I've changed to use native PHP array function
        // I'm not sure if it "improves" performance
        \array_walk(
            $this->board,
            function ($val, $i) use (&$foundCount, $symbol, $pattern) {
                /** @var Player $val */
                if (\is_null($val) === false && $val->symbol()->value() === $symbol->value() && $pattern[$i] == '#') {
                    $foundCount++;
                }
            }
        );
        return $foundCount;
    }

    private function findWinnerByBoardPatterns(Symbol $symbol)
    {
        // Here were loop, but now I've changed to use native PHP array function
        // I'm not sure if it "improves" performance
        $found = \array_reduce(
            self::patterns,
            function ($carry, $pattern) use ($symbol) {
                $carry =
                (
                    $carry ||
                    $this->countFieldsMatchedToPattern($pattern, $symbol) === 3
                );
                return $carry;
            },
            false
        );

        if ($found === false) {
            return null;
        }
        return $this->players[$symbol->value()];
    }
}
