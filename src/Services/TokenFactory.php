<?php

namespace EthicalJobs\Token\Services;

use Carbon\Carbon;
use EthicalJobs\Token\Models\Token;
use Illuminate\Support\Str;

class TokenFactory
{
    /**
     * {@inheritdoc}
     */
    public function create(): Token
    {
        $expirationHours = config('token.expires', 120);
        $token = new Token();
        $token->secret = $this->generateHash();
        $token->expires_at = Carbon::now()->addHours($expirationHours)->second(0);
        $token->uuid = (string) Str::uuid();
        $token->save();

        return $token;
    }

    /**
     * Generates a unique cryptographic hash
     *
     * @return string
     */
    protected function generateHash(): string
    {
        $uniqueRandomString = Str::random(30);

        $salt = config('token.key');

        if (Str::startsWith($salt, 'base64:')) {
            $salt = base64_decode(substr($salt, 7));
        }

        return hash_hmac('sha256', $uniqueRandomString, $salt);
    }
}