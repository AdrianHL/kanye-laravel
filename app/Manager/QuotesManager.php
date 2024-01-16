<?php

namespace App\Manager;

use Illuminate\Support\Manager;

class QuotesManager extends Manager
{
    public function getDefaultDriver(): string
    {
        return $this->config->get('quotes-manager.driver', 'kayne');
    }

    public function createKayneDriver(): QuotesInterface
    {
        return new KayneWestQuotes();
    }

}