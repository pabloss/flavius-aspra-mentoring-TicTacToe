<?php
declare(strict_types=1);

namespace TicTacToe;

class Tile
{
    private $row;
    private $column;

    public function __construct($row, $column)
    {
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
