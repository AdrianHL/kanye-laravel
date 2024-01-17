<?php

namespace Tests\Unit;

use App\Manager\KayneWestQuotes;
use PHPUnit\Framework\TestCase;

class KayneWestQuotesTest extends TestCase
{
    /**
     * Test that the quotes manager return quotes from Kayne West API
     *
     * @dataProvider numberOfQuotes
     */
    public function test_quotes_manager_retrieve_quotes_from_kayne_west_api($numberOfQuotes, $returnedQuotes): void
    {
        $quotesAPI = new KayneWestQuotes();

        $quotes = $quotesAPI->quotes($numberOfQuotes);

        $this->assertCount($returnedQuotes, $quotes);

        foreach ($quotes as $quote) {
            $this->assertIsString($quote);
        }
    }

    public static function numberOfQuotes()
    {
        return [
            [-1, 0],
            [0, 0],
            [2, 2],
            [5, 5],
        ];
    }
}
