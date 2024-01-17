<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * Ensure that the API routes require a token to get access
     */
    public function test_the_api_is_not_accessible_without_token(): void
    {
        $paths = ['/api', '/api/refresh'];

        foreach ($paths as $path) {
            $response = $this->get($path);
            $response->assertStatus(403);
        }
    }

    /**
     * Ensure that the API routes require an invalid token to get access
     */
    public function test_the_api_is_not_accessible_with_an_invalid_token(): void
    {
        $paths = ['/api', '/api/refresh'];

        foreach ($paths as $path) {
            $response = $this->get($path.'?token=different_token');
            $response->assertStatus(403);
        }
    }

    /**
     * Get the expected amount of quotes from the API when using the valid token
     */
    public function test_api_returns_expected_amount_of_quotes(): void
    {
        $response = $this->getJson('/api?token=test_token');
        $response->assertStatus(200);

        $response->assertJson(fn (AssertableJson $json) => $json->whereType('quotes', 'array')
            ->has('quotes', 5)
            ->whereType('quotes.0', 'string')
            ->whereType('quotes.1', 'string')
            ->whereType('quotes.2', 'string')
            ->whereType('quotes.3', 'string')
            ->whereType('quotes.4', 'string')
        );
    }

    /**
     * Get the expected amount of quotes from the API when using the valid token
     */
    public function test_api_refresh_and_returns_expected_amount_of_quotes(): void
    {
        $response = $this->getJson('/api/refresh?token=test_token');
        $response->assertStatus(200);

        $response->assertJson(fn (AssertableJson $json) => $json->whereType('quotes', 'array')
            ->has('quotes', 5)
            ->whereType('quotes.0', 'string')
            ->whereType('quotes.1', 'string')
            ->whereType('quotes.2', 'string')
            ->whereType('quotes.3', 'string')
            ->whereType('quotes.4', 'string')
        );
    }

    /**
     * Returns new quotes from API if requested
     */
    public function test_api_returns_new_quotes_if_requested(): void
    {
        $response = $this->getJson('/api?token=test_token');
        $response->assertStatus(200);

        $refreshResponse = $this->getJson('/api/refresh?token=test_token');
        $refreshResponse->assertStatus(200);

        $this->assertNotEquals($response->content(), $refreshResponse->content());
    }

    /**
     * Returns the same quotes from API if not refreshed
     */
    public function test_api_returns_same_quotes(): void
    {
        $firstResponse = $this->getJson('/api?token=test_token');
        $firstResponse->assertStatus(200);

        $secondResponse = $this->getJson('/api?token=test_token');
        $secondResponse->assertStatus(200);

        $this->assertEquals($firstResponse->content(), $secondResponse->content());
    }
}
