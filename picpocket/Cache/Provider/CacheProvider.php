<?php

namespace Picpocket\Cache\Provider;

use Carbon\Laravel\ServiceProvider;
use Picpocket\Cache\Service\CacheServiceFactory;
use Picpocket\Cache\Service\CacheServiceInterface;

/**
 * Class CacheProvider
 *
 * Service provider to bind the CacheService to its factory implementation.
 *
 * This provider ensures that the CacheService is correctly registered in the
 * Laravel service container, using the CacheServiceFactory to handle its creation.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class CacheProvider extends ServiceProvider
{
    /**
     * Register the cache service provider.
     *
     * This method ensures that the CacheService is bound to the Laravel container
     * using the CacheServiceFactory for instantiation.
     *
     * @return void
     */
    public function register()
    {
        $this->bindCacheService();
    }

    /**
     * Bind the CacheService to its factory implementation.
     *
     * This method uses the CacheServiceFactory to create and bind an instance
     * of CacheService into the Laravel service container.
     *
     * @return void
     */
    protected function bindCacheService()
    {
        $this->app->bind(CacheServiceInterface::class, function () {
            return (new CacheServiceFactory)();
        });
    }
}
