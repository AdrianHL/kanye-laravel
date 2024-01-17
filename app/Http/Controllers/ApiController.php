<?php

namespace App\Http\Controllers;

use App\Manager\Quotes;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class ApiController extends Controller
{
    private const QUOTES_CACHE_KEY = 'api.quotes.cache';

    private const QUOTES_AMOUNT = 5;

    /**
     * Shows 5 quotes from Kanye West Quotes API (from cached data)
     */
    public function view(): JsonResponse
    {
        return response()->json([
            'quotes' => $this->getQuotes(),
        ]);
    }

    /**
     * Invalidates the cached data and shows 5 new quotes from Kanye West Quotes API
     */
    public function refresh(): JsonResponse
    {
        Cache::forget(self::QUOTES_CACHE_KEY);

        return response()->json([
            'quotes' => $this->getQuotes(),
        ]);
    }

    /**
     * Gets the quotes and store these in cache forever
     */
    private function getQuotes(): array
    {
        return Cache::rememberForever(self::QUOTES_CACHE_KEY, function () {
            return Quotes::driver('kanye')->quotes(self::QUOTES_AMOUNT);
        });
    }
}
