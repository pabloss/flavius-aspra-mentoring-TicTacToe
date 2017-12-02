<?php
declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Exception\NotAllowedSymbolValue;

class Symbol
{
    const ALLOWED_SYMBOL_VALUES = ['X', '0'];

    private $value;

    public function __construct($value)
    {
        if (
            ($value !== '0') &&
            (
                empty($value) ||
                !in_array($value, self::ALLOWED_SYMBOL_VALUES)
            )
        ) {
            throw new NotAllowedSymbolValue();
        }

        $this->value = $value;
    }


    public function value()
    {
        return $this->value;
    }
}
