<?php

namespace App\Manager;

interface QuotesInterface
{
    public function quotes(int $num = 5): array;
}
