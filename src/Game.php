<?php
declare(strict_types=1);

namespace TicTacToe;

class Game
{
    const patterns = [
        'X' => [
            [
            'X', 'X', 'X',
            ' ', ' ', ' ',
            ' ', ' ', ' ',
            ],
            [
            ' ', ' ', ' ',
            'X', 'X', 'X',
            ' ', ' ', ' ',
            ],
            [
            ' ', ' ', ' ',
            ' ', ' ', ' ',
            'X', 'X', 'X',
            ],
            [
            'X', ' ', ' ',
            'X', ' ', ' ',
            'X', ' ', ' ',
            ],
            [
            ' ', 'X', ' ',
            ' ', 'X', ' ',
            ' ', 'X', ' ',
            ],
            [
            ' ', ' ', 'X',
            ' ', ' ', 'X',
            ' ', ' ', 'X',
            ],
            [
            'X', ' ', ' ',
            ' ', 'X', ' ',
            ' ', ' ', 'X',
            ],
            [
            ' ', ' ', 'X',
            ' ', 'X', ' ',
            'X', ' ', ' ',
            ]
        ],
        '0' => [
                [
                '0', '0', '0',
                ' ', ' ', ' ',
                ' ', ' ', ' ',
                ],
                [
                ' ', ' ', ' ',
                '0', '0', '0',
                ' ', ' ', ' ',
                ],
                [
                ' ', ' ', ' ',
                ' ', ' ', ' ',
                '0', '0', '0',
                ],
                [
                '0', ' ', ' ',
                '0', ' ', ' ',
                '0', ' ', ' ',
                ],
                [
                ' ', '0', ' ',
                ' ', '0', ' ',
                ' ', '0', ' ',
                ],
                [
                ' ', ' ', '0',
                ' ', ' ', '0',
                ' ', ' ', '0',
                ],
                [
                '0', ' ', ' ',
                ' ', '0', ' ',
                ' ', ' ', '0',
                ],
                [
                ' ', ' ', '0',
                ' ', '0', ' ',
                '0', ' ', ' ',
                ]
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
        $this->board = \array_fill(0, 9, ' ');
        $this->history = [];
        $this->errors = 0;
    }

    public function players($symbolX, $symbol0)
    {
        if ($symbolX === $symbol0) {
            $this->errors |= self::DUPLICATED_PLAYERS_ERROR;
        }

        $this->startingPlayerSymbol = $symbolX;

        $this->players[$symbolX] = new Player($symbolX, $this);
        $this->players[$symbol0] = new Player($symbol0, $this);

        return [
            $this->players[$symbolX],
            $this->players[$symbol0]
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

        $this->saveLastTurn($player);

        $this->markBoard($tile, $player);

        $this->saveTurnToHistory($tile);
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
        $this->board[$tile->column() + 3 * $tile->row()] = $player->symbol();
    }

    private function saveTurnToHistory(Tile $tile): void
    {
        $this->history[\count($this->history) % 9] = [$tile->row(), $tile->column()];
    }

    private function countFieldsMatchedToPattern($pattern, $symbol)
    {
        $foundCount = 0;
        foreach ($this->board as $key => $field) {
            if ($field == $symbol && $pattern[$key] == $field) {
                $foundCount++;
            }
        }
        return $foundCount;
    }

    private function findWinnerByBoardPatterns($symbol)
    {
        $foundCount = 0;
        foreach (self::patterns[$symbol] as $pattern) {
            $foundCount = $this->countFieldsMatchedToPattern($pattern, $symbol);
            if ($foundCount === 3) {
                break;
            }
        }
        if ($foundCount !== 3) {
            return null;
        }
        return $this->players[$symbol];
    }
}
