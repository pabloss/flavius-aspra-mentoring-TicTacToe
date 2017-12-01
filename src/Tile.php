<?php
declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Exception\OutOfLegalSizeException;

class Tile
{
    const POSITION_UPPER_LIMIT = 3;
    private $row;
    private $column;

    public function __construct($row, $column)
    {
        if ($row < 0 || $row >= self::POSITION_UPPER_LIMIT) {
            throw new OutOfLegalSizeException();
        }

        if ($column < 0 || $column >= self::POSITION_UPPER_LIMIT) {
            throw new OutOfLegalSizeException();
        }
        $this->row = $row;
        $this->column = $column;
    }

    public function row()
    {
        return $this->row;
    }

    public function column()
    {
        return $this->column;
    }
}
