<?php

namespace EthicalJobs\Token\Services;

use Carbon\Carbon;
use EthicalJobs\Token\Models\Token;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

/**
 * @deprecated
 */
class TokenFactory
{
    /**
     * {@inheritdoc}
     * @deprecated
     */
    public function create(): Token
    {
        $expirationHours = config('token.expires', 120);
        $token = new Token();
        $token->secret = $this->generateHash();
        $token->expires_at = Carbon::now()->addHours($expirationHours)->second(0);
        $token->uuid = Uuid::uuid4()->toString();
        $token->save();

        return $token;
    }

    /**
     * Generates a unique cryptographic hash
     *
     * @return string
     * @deprecated
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