<?php
declare(strict_types=1);

namespace TicTacToe\Game;

class History
{
    const LIMIT = 9;

    private $timeLine = [];

    public function set($value)
    {
        $this->timeLine[$this->length() % self::LIMIT] = $value;
    }

    public function getLast()
    {
        return \end($this->timeLine);
    }

    public function length()
    {
        return \count($this->timeLine);
    }

    public function &content()
    {
        return $this->timeLine;
    }
}
