<?php

namespace App\Manager;

use Illuminate\Support\Manager;

class QuotesManager extends Manager
{
    public function getDefaultDriver(): string
    {
        return $this->config->get('quotes-manager.driver', 'kanye');
    }

    public function createKanyeDriver(): QuotesInterface
    {
        return new KanyeWestQuotes();
    }
}
