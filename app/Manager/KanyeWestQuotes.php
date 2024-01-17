<?php

namespace App\Manager;

class KanyeWestQuotes implements QuotesInterface
{
    private const API_URL = 'https://api.kanye.rest/';

    private function getQuote(): string
    {
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, self::API_URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            $responseContent = json_decode($response, true);

            if (isset($responseContent['quote'])) {
                return $responseContent['quote'];
            }

            throw new \Exception('Kanye API Is Not Responsive');
        } catch (\Exception $e) {
            throw new \Exception('Kanye API Is Not Responsive');
        }
    }

    public function quotes(int $num = 5): array
    {
        if (! $num || $num < 1) {
            return [];
        }

        $quotes = [];

        do {
            $quote = $this->getQuote();
            $key = md5($quote);
            $quotes[$key] = $quote;
        } while (count($quotes) < $num);

        return array_values($quotes);
    }
}
