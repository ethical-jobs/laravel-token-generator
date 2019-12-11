<?php

namespace EthicalJobs\Token;

/**
 * Service provider
 * @deprecated
 */
class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Config file path
     *
     * @var string
     */
    protected $configPath = __DIR__ . '/../config/token.php';

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            $this->configPath => config_path('token.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Bind Repository interfaces to their appropriate implementations.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom($this->configPath, 'token');
    }
}