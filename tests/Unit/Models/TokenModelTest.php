<?php

namespace Tests\Integration\Models;

use Carbon\Carbon;
use EthicalJobs\Token\Models\Token;

class TokenModelTest extends \Orchestra\Testbench\TestCase
{
    /**
     * @test
     * @group Integration
     */
    public function it_can_determine_if_its_token_has_expired()
    {
        $expiredToken = new Token(['expires_at' => Carbon::now()->subDays(1)]);

        $this->assertTrue($expiredToken->isExpired());

        $validToken = new Token(['expires_at' => Carbon::now()->addDays(1)]);

        $this->assertFalse($validToken->isExpired());
    }

    /**
     * @test
     * @group Integration
     */
    public function it_can_determine_if_its_token_has_not_expired()
    {
        $expiredToken = new Token([
            'expires_at' => Carbon::now()->subDays(1),
        ]);

        $this->assertFalse($expiredToken->isNotExpired());

        $validToken = new Token([
            'expires_at' => Carbon::now()->addDays(1),
        ]);

        $this->assertTrue($validToken->isNotExpired());
    }
}
