<?php

namespace App\Manager;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string driver(string $driver = null)
 * @method static array quotes(int $num = 5)
 *
 * @see QuotesManager
 */
class Quotes extends Facade
{
    protected static function getFacadeAccessor()
    {
        return QuotesManager::class;
    }
}