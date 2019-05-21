<?php

namespace EthicalJobs\Token\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Token entity
 *
 * @property int $id
 * @property string $uuid
 * @property string $secret
 * @property Carbon $expires_at
 */

class Token extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'secret',
        'expires_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expires_at',
    ];

    /**
     * Has the token expired
     *
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Has the token not expired
     *
     * @return bool
     */
    public function isNotExpired(): bool
    {
        return $this->expires_at->isFuture();
    }
}