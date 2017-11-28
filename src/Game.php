<?php
declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Exception\DuplicatePlayersException;
use TicTacToe\Exception\DuplicateTurnsException;

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

    private $board;
    private $history;
    private $lastTurn;

    private $players;

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

    public function start()
    {
        $this->lastTurn = null;
        $this->board = \array_fill(0, 9, ' ');
        $this->history = [];
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

    private function countFieldsMatchedToPattern($pattern)
    {
        $foundCount = 0;
        foreach ($this->board as $key => $field) {
            if ($field == 'X' && $pattern[$key] == $field) {
                $foundCount++;
            }
        }
        return $foundCount;
    }

    private function findWinnerByBoardPatterns($symbol)
    {
        foreach (self::patterns[$symbol] as $pattern) {
            $foundCount = $this->countFieldsMatchedToPattern($pattern);
            if ($foundCount === 3) {
                break;
            }
        }
        return $this->players[$symbol];
    }
}
