<?php
declare(strict_types=1);

namespace TicTacToe\Type;

use TicTacToe\Exception\NotAllowedTypeValue;

class PlayerType
{
    const POSSIBLE_TYPES = ['AI', 'Real'];

    private $value;

    public function __construct($value)
    {
        if (!\in_array($value, self::POSSIBLE_TYPES)) {
            throw new NotAllowedTypeValue();
        }
        $this->value = $value;
    }


    public function value()
    {
        return $this->value;
    }
}
