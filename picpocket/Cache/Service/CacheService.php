<?php

namespace Picpocket\Cache\Service;

use Illuminate\Support\Facades\Cache;

/**
 * Class CacheService
 *
 * Implements the CacheServiceInterface to provide centralized cache operations
 * using Laravel's caching system.
 *
 * This service handles storing, retrieving, and removing cache entries, offering
 * a clean and reusable interface for cache management.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class CacheService implements CacheServiceInterface
{
    public function __construct(
    )
    {
    }
    /**
     * @inheritdoc
     */
    public function remember(string $key, int $ttl, callable $callback): mixed
    {
        return Cache::remember($key, $ttl, $callback);
    }

    /**
     * @inheritdoc
     */
    public function get(string $key): mixed
    {
        return Cache::get($key);
    }

    /**
     * @inheritdoc
     */
    public function put(string $key, mixed $value, int $ttl): void
    {
        Cache::put($key, $value, $ttl);
    }

    /**
     * @inheritdoc
     */
    public function forget(string $key): void
    {
        Cache::forget($key);
    }
}
