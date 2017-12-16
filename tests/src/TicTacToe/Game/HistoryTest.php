<?php
declare(strict_types=1);

namespace TicTacToeTest\src\TicTacToe;

use PHPUnit\Framework\TestCase;
use TicTacToe\Game\History;

class HistoryTest extends TestCase
{
    /**
     * @test
     */
    public function history_should_record_values()
    {
        $history = new History();
        $value = [1, 1, 1];
        $history->set($value);
        self::assertEquals($value, $history->getLast());
    }

    /**
     * @test
     */
    public function sequence_of_sets_below_limit_should_take_correct_length()
    {
        $history = new History();
        $value1 = [1, 1, 1];
        $value2 = [1, 0];
        $history->set($value1);
        self::assertEquals($value1, $history->getLast());
        $history->set($value2);
        self::assertEquals($value2, $history->getLast());

        self::assertEquals(2, $history->length());

        for ($i = 0; $i < ($history::LIMIT * 2); $i++) {
            $history->set(\rand(0, 1000));
        }
        self::assertEquals($history::LIMIT, $history->length());
    }
}
