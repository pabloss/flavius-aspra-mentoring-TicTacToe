<?php
declare(strict_types=1);

namespace TicTacToe;

use TicTacToe\Exception\NotAllowedSymbolValue;

class Symbol
{
    const PLAYER_X_SYMBOL = 'X';
    const PLAYER_0_SYMBOL = '0';

    private $value;

    public function __construct($value)
    {
        if (!in_array(
            $value,
            [
                self::PLAYER_X_SYMBOL,
                self::PLAYER_0_SYMBOL
            ],
            true
        )) {
            throw new NotAllowedSymbolValue();
        }

        $this->value = $value;
    }


    public function value()
    {
        return $this->value;
    }
}
