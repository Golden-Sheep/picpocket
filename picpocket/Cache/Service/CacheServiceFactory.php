<?php

namespace Picpocket\Cache\Service;

/**
 * Class CacheServiceFactory
 *
 * Factory for creating instances of the CacheService class.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class CacheServiceFactory
{
    /**
     * Creates a new instance of the CacheService.
     *
     * @return CacheService
     */
    public function __invoke(): CacheService
    {
        return new CacheService();
    }
}
