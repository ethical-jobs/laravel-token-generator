<?php

namespace Tests\Integration\Services\Auth;

use Carbon\Carbon;
use EthicalJobs\Token\Services\TokenFactory;

class TokenFactoryTest extends \Orchestra\Testbench\TestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/../../../database/migrations');

        \Config::set('token.expires', 192);
    }

    /**
     * @test
     * @group Integration
     */
    public function it_can_create_a_token_with_a_unique_secret()
    {
        $tokenFactory = new TokenFactory;

        $tokens = collect();

        for ($i = 0; $i < 100; $i++) {
            $token = $tokenFactory->create();
            $tokens->push($token->secret);
        }

        $withoutDuplicates = $tokens->unique();

        $this->assertEquals($tokens->count(), $withoutDuplicates->count());
    }

    /**
     * @test
     * @group Integration
     */
    public function it_creates_tokens_with_correct_expiration()
    {
        $expectedExpiration = Carbon::now()->addHours(
            config('token.expires')
        )->second(0);

        $tokenFactory = new TokenFactory;

        $token = $tokenFactory->create();

        $this->assertEquals((string) $expectedExpiration, (string) $token->expires_at);
    }
}
